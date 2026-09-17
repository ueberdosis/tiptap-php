import { Details, DetailsContent, DetailsSummary } from '@tiptap/extension-details'
import Highlight from '@tiptap/extension-highlight'
import Image from '@tiptap/extension-image'
import { TaskItem, TaskList } from '@tiptap/extension-list'
import Mention from '@tiptap/extension-mention'
import Subscript from '@tiptap/extension-subscript'
import Superscript from '@tiptap/extension-superscript'
import { Table, TableCell, TableHeader, TableRow } from '@tiptap/extension-table'
import TextAlign from '@tiptap/extension-text-align'
import { Color, FontFamily, TextStyle } from '@tiptap/extension-text-style'
import { generateHTML, generateJSON } from '@tiptap/html/server'
import StarterKit from '@tiptap/starter-kit'
import { readFileSync } from 'node:fs'

const starterKit = (options = {}) => StarterKit.configure({
  dropcursor: false,
  gapcursor: false,
  link: false,
  listKeymap: false,
  trailingNode: false,
  underline: false,
  undoRedo: false,
  ...options,
})

const profiles = {
  starterKit: () => [starterKit()],
  marks: () => [
    starterKit({ link: {}, underline: {} }),
    Highlight.configure({ multicolor: true }),
    Subscript,
    Superscript,
  ],
  styles: () => [
    starterKit(),
    TextStyle,
    Color,
    FontFamily,
    TextAlign.configure({ types: ['heading', 'paragraph'] }),
  ],
  image: () => [starterKit(), Image],
  mention: () => [
    starterKit(),
    Mention.configure({
      renderHTML: ({ node }) => [
        'span',
        {
          'data-id': node.attrs.id,
          'data-type': 'mention',
        },
      ],
    }),
  ],
  taskList: () => [starterKit(), TaskList, TaskItem],
  table: () => [starterKit(), Table, TableRow, TableHeader, TableCell],
  details: () => [
    starterKit(),
    Details.configure({ persist: true }),
    DetailsSummary,
    DetailsContent,
  ],
}

try {
  const request = JSON.parse(readFileSync(0, 'utf8'))
  const createExtensions = profiles[request.profile]

  if (!createExtensions) {
    throw new Error(`Unknown extension profile: ${request.profile}`)
  }

  const extensions = createExtensions()
  const result = request.operation === 'parse'
    ? generateJSON(request.value, extensions)
    : request.operation === 'render'
      ? generateHTML(request.value, extensions)
      : (() => { throw new Error(`Unknown operation: ${request.operation}`) })()

  process.stdout.write(JSON.stringify(result))
} catch (error) {
  process.stderr.write(`${error.stack ?? error.message}\n`)
  process.exitCode = 1
}

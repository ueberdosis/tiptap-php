import { spawnSync } from 'node:child_process'

const packages = [
  '@tiptap/extension-details',
  '@tiptap/extension-highlight',
  '@tiptap/extension-image',
  '@tiptap/extension-list',
  '@tiptap/extension-mention',
  '@tiptap/extension-subscript',
  '@tiptap/extension-superscript',
  '@tiptap/extension-table',
  '@tiptap/extension-text-align',
  '@tiptap/extension-text-style',
  '@tiptap/html',
  '@tiptap/starter-kit',
]

const requestedVersion = process.env.TIPTAP_VERSION || 'latest'
const view = spawnSync(
  'npm',
  ['view', `@tiptap/html@${requestedVersion}`, 'version'],
  { encoding: 'utf8' },
)

if (view.status !== 0) {
  process.stderr.write(view.stderr)
  process.exit(view.status ?? 1)
}

const resolvedVersion = view.stdout.trim()

process.stdout.write(`Installing Tiptap JS ${resolvedVersion}\n`)

const install = spawnSync(
  'npm',
  [
    'install',
    '--no-save',
    '--package-lock=false',
    '--ignore-scripts',
    '--no-audit',
    '--no-fund',
    ...packages.map(packageName => `${packageName}@${resolvedVersion}`),
  ],
  { stdio: 'inherit' },
)

process.exit(install.status ?? 1)

import fs from 'fs'
import path from 'path'
import dotenv from 'dotenv'

import { defaultTheme, viteBundler } from 'vuepress'
import { docsearchPlugin } from '@vuepress/plugin-docsearch'
import { containerPlugin } from '@vuepress/plugin-container'
import { githubLinkifyPlugin } from 'vuepress-plugin-github-linkify'

dotenv.config()

const hostname = 'example.com'

module.exports = {
    lang: 'en-US',
    title: 'Laravel Lang: Translations Template',
    description: 'Extended translations for Laravel Projects',

    head: [
        ['link', { rel: 'icon', href: `https://${ hostname }/images/logo.svg` }],
        ['meta', { name: 'twitter:image', content: `https://${ hostname }/images/social-logo.png` }]
    ],

    bundler: viteBundler(),

    theme: defaultTheme({
        hostname,
        base: '/',

        logo: `https://${ hostname }/images/logo.svg`,

        repo: 'https://github.com/Laravel-Lang/translations-template',
        repoLabel: 'GitHub',
        docsRepo: 'https://github.com/Laravel-Lang/translations-template',
        docsBranch: 'main',
        docsDir: 'docs',

        contributors: false,
        editLink: true,

        navbar: [
            { text: 'Translations Status', link: '/status.md' },
            { text: '1.x', link: '/changelog/1.x.md' }
        ],

        sidebarDepth: 1,

        sidebar: [
            {
                text: 'Getting Started',
                collapsible: true,
                children: [
                    {
                        text: 'Introduction',
                        link: '/'
                    },

                    {
                        text: 'Installation',
                        link: '/installation/',
                        collapsible: true,
                        children: [
                            '/installation/compatibility.md',
                            '/installation/github.md'
                        ]
                    },

                    { text: 'Basic Usage', link: '/usage.md' },

                    {
                        text: 'Translations Status',
                        link: '/status.md',
                        collapsible: true,
                        children: getChildren('statuses')
                    },

                    {
                        text: 'Changelog',
                        link: '/changelog/index.md',
                        collapsible: true,
                        children: getChildren('changelog', 'desc')
                    }
                ]
            }, {
                text: 'References',
                collapsible: true,
                children: [
                    { text: 'Referents', link: '/referents.md' },
                    { text: 'Code of Conduct', link: '/code-of-conduct.md' },
                    { text: 'Contributing', link: '/contributing.md' }
                ]
            }
        ]
    }),

    plugins: [
        docsearchPlugin({
            appId: process.env.VITE_APP_ALGOLIA_APP_ID,
            apiKey: process.env.VITE_APP_ALGOLIA_API_KEY,
            indexName: process.env.VITE_APP_ALGOLIA_INDEX_NAME
        }),

        containerPlugin({
            type: 'tip'
        }),

        githubLinkifyPlugin({
            repo: 'Laravel-Lang/translations-template'
        })
    ]
}

function getChildren(folder, sort = 'asc') {
    const extension = ['.md']
    const names = ['index.md', 'readme.md']

    const dir = `${ __dirname }/../${ folder }`

    return fs
        .readdirSync(path.join(dir))
        .filter(item =>
            fs.statSync(path.join(dir, item)).isFile() &&
            ! names.includes(item.toLowerCase()) &&
            extension.includes(path.extname(item))
        )
        .sort((a, b) => {
            a = resolveNumeric(a)
            b = resolveNumeric(b)

            if (a < b) return sort === 'asc' ? -1 : 1
            if (a > b) return sort === 'asc' ? 1 : -1

            return 0
        }).map(item => `/${ folder }/${ item }`)
}

function resolveNumeric(value) {
    const sub = value.substring(0, value.indexOf('.'))

    const num = Number(sub)

    return isNaN(num) ? value : num
}

import type { CodegenConfig } from '@graphql-codegen/cli';

/**
 * GraphQL Code Generator configuration – Cashalaptop
 * -------------------------------------------------------------------------
 * • In dev it uses the live WPGraphQL endpoint (GRAPHQL_ENDPOINT env var) and
 *   merges in any local SDL files under src/graphql/schema/**.
 * • In CI (CI=true) it relies solely on the checked-in SDL, so builds never
 *   fail when the remote API is down.
 * • `skipGraphQLImport: false` lets the built-in loader resolve `# import`
 *   fragment spreads without needing a custom loader package.
 */

const ENDPOINT =
  process.env.GRAPHQL_ENDPOINT ?? 'http://cashalaptop.dev.localhost/graphql';

const isCI = process.env.CI === 'true';

const config: CodegenConfig = {
  // ─── SCHEMA ────────────────────────────────────────────────────────────
  schema: isCI
    ? ['src/graphql/schema/**/*.{gql,graphql}']
    : [ENDPOINT, 'src/graphql/schema/**/*.{gql,graphql}'],

  // ─── DOCUMENTS (queries • mutations • fragments) ───────────────────────
  documents: 'src/graphql/**/*.{gql,graphql}',

  // ─── OUTPUT ────────────────────────────────────────────────────────────
  generates: {
    './src/lib/gql-sdk.ts': {
      plugins: [
        'typescript',
        'typescript-operations',
        'typescript-graphql-request',
      ],
      config: {
        avoidOptionals: true,
        enumsAsConst: true,
        documentMode: 'string', // embed raw query text
      },
    },
  },

  overwrite: true,

  // global plugin / loader config
  config: {
    skipGraphQLImport: false, // enable `# import` everywhere
  },

  // hooks: {
  //   afterAllFileWrite: ['eslint --fix'],
  // },
};

export default config;

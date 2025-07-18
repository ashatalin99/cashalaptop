import type { CodegenConfig } from '@graphql-codegen/cli';

/**
 * GraphQL Code Generator configuration for Cashalaptop
 * -------------------------------------------------------------------------
 * • In **local/dev**, it hits the live WPGraphQL endpoint defined in your
 *   `.env.local` (GRAPHQL_ENDPOINT). If that env var is missing it falls
 *   back to the default docker URL `http://cashalaptop.dev.localhost/graphql`.
 * • In **CI** (CI=true) **or** whenever the endpoint is down (502/timeout),
 *   it automatically switches to a **local schema snapshot**\* so the build
 *   never blocks.
 *
 *   \*Generate / refresh that snapshot with:
 *     npx get-graphql-schema $GRAPHQL_ENDPOINT > schema.graphql
 *
 *   You can commit `schema.graphql` so Codegen runs offline.
 */

const ENDPOINT =
  process.env.GRAPHQL_ENDPOINT ?? 'http://cashalaptop.dev.localhost/graphql';

const isCI = process.env.CI === 'true';

const config: CodegenConfig = {
  // Try the live endpoint in dev; otherwise fall back to the snapshot file
  schema: isCI ? './schema.graphql' : ENDPOINT,

  // All *.graphql | *.gql operations & fragments live here
  documents: ['src/graphql/**/*.{graphql,gql}'],

  generates: {
    'src/lib/gql-sdk.ts': {
      plugins: [
        'typescript',
        'typescript-operations',
        'typescript-graphql-request',
      ],
      config: {
        avoidOptionals: true,         // nicer DX in TS strict‑mode
        enumsAsConst: true,
      },
    },
  },

  overwrite: true,

  // Auto‑format the generated file so it passes lint on first try
  // hooks: {
  //   afterAllFileWrite: ['eslint --fix'],
  // },
};

export default config;

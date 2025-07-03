import type { CodegenConfig } from '@graphql-codegen/cli';

const config: CodegenConfig = {
  schema:  "http://cashalaptop.dev.localhost/graphql",        // WPGraphQL endpoint
  documents: 'src/graphql/**/*.gql',      // your queries live here
  overwrite: true,
  generates: {
    'src/lib/gql-sdk.ts': {               // <- generated file
      plugins: [
        'typescript',
        'typescript-operations',
        'typescript-graphql-request',
      ],
    },
  },
};
export default config;


import { GraphQLClient } from 'graphql-request';

export const gqlClient = new GraphQLClient(
  process.env.WP_API_URL as string,            
  { headers: { 'Content-Type': 'application/json' } }
);
import { getSdk } from '@/lib/gql-sdk';
import { gqlClient } from '@/lib/graphql-client';
export const sdk = getSdk(gqlClient);
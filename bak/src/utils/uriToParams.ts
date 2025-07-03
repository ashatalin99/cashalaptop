export function uriToParams(uri: string) {
  return uri.split('/').filter(Boolean); 
}
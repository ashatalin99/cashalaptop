import { request, gql } from 'graphql-request'

type PostsResponse = {
  posts: {
    nodes: { slug: string }[]
  }
};

export async function generateStaticParams() {
  const { posts } = await request<PostsResponse>(process.env.WP_API_URL!, gql`
    { posts(first: 100) { nodes { slug } } }
  `)
  return posts.nodes.map((p: any) => ({ slug: p.slug }))
}

type PostPageProps = {
  params: {
    slug: string
  }
};

type PostResponse = {
  post: {
    title: string;
    content: string;
    featuredImage: {
      node: {
        sourceUrl: string;
        altText: string;
      } | null;
    } | null;
  };
};

export default async function Post({ params }: PostPageProps) {
  const { post } = await request<PostResponse>(process.env.WP_API_URL!, gql`
    query ($slug: String!) {
      post(slug: $slug) {
        title
        content
        featuredImage { node { sourceUrl altText } }
      }
    }`, { slug: params.slug });

  return (
    <article className="prose mx-auto">
      <h1>{post.title}</h1>
      <div dangerouslySetInnerHTML={{ __html: post.content }} />
    </article>
  )
}
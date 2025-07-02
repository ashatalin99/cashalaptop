import { sdk } from '@/lib/sdk';
import type { Metadata } from 'next';
import { notFound } from 'next/navigation';

interface Params {
  slug: string;
}

/* BUILD-TIME paths ------------------------------------------------------- */
export async function generateStaticParams() {
  const { laptops } = await sdk.GetLaptopSlugs();
  return laptops?.nodes?.map(({ slug }) => ({ slug })) ?? [];
}

/* OPTIONAL: dynamic <head> tags ----------------------------------------- */
export async function generateMetadata(
  { params }: { params: Promise<{ slug: string }> }
): Promise<Metadata> {
  const { slug } = await params;
  const { postBy } = await sdk.LaptopBySlug({ slug });
  if (!postBy) return {};
  return { title: postBy.title };
}

/* ISR: rebuild at most once a minute ------------------------------------ */
export const revalidate = 60;

/* PAGE: strongly typed --------------------------------------------------- */
export default async function Post( { params }: { params: Promise<{ slug: string }> }) {
  const { slug } = await params;

  const { postBy } = await sdk.PostBySlug({ slug });

  if (!postBy) notFound();

  return (
    <article className="prose mx-auto">
      <h1>{postBy.title}</h1>

      {/* {postBy.featuredImage?.node && (
        <img
          src={postBy.featuredImage.node.sourceUrl}
          alt={postBy.featuredImage.node.altText ?? postBy.title}
          className="mb-4"
        />
      )} */}

      <div dangerouslySetInnerHTML={{ __html: postBy.content ?? '' }} />
    </article>
  );
}
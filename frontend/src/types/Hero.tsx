export interface Hero {
  title: string;
  subtitle?: string;
  image: { src: string; alt: string };
  cta?: { url: string; label: string; target?: "_blank" | "_self" };
}
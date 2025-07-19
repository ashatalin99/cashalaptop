export interface Brand {
  id: string;
  name: string;
  slug: string;
  description?: string;
}

export interface BrandProps {
  terms: Brand[];
};
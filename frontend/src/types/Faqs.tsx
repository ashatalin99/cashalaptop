export interface Faq {
    id: string;
    title: string;
    content: string;
    description?: string;
}

export interface FaqProps {
    faqs: Faq[];
};
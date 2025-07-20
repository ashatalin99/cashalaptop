import { FaqProps } from "@/types/Faqs";

const Faqs = ({ faqs }: FaqProps) => {
    if (!faqs || faqs.length === 0)  return

    return (
        <section className="max-w-7xl mx-auto mb-8 px-4 py-8 flex flex-col items-center justify-center">
            <h2 className="text-2xl font-semibold mb-8">Frequently Asked Questions</h2>
            <div className="shadow-[0px_0px_15px_1px_rgba(0,0,0,0.3)] w-[800px]">
                {faqs.map((faq) => (
                    <details key={faq.id} className="group">
                        <summary className="p-4 cursor-pointer border-b border-[#ddd] border-1 list-none flex items-center ">
                            <svg
                                className="w-4 h-4 
                                        group-open:rotate-180 mr-2"
                                xmlns="http://www.w3.org/2000/svg"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                                >
                                <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2"
                                        d="M19 9l-7 7-7-7" />
                            </svg>
                            {faq.title}
                        </summary>
                        <div className="p-4 bg-[#eee]" dangerouslySetInnerHTML={{ __html: faq.content ?? "" }} />
                    </details>
                ))}
            </div>
        </section>
    );
};

export  { Faqs };

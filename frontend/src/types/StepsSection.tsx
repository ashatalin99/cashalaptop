export interface Item {
    title?: string;
    subtitle?: string;
    icon?: { sourceUrl?: string };
    
  };

export interface StepsSection {
    title: string;
    items: Item[];
}


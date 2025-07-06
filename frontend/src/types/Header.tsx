export interface HeaderItem {
    id: string;
    label: string;
    url: string;
    parentId: string; 
    target: "_blank" | "_self";
    childItems: { nodes: HeaderItem[] }
}

export interface HeaderItems {
    navItems: HeaderItem[];
}
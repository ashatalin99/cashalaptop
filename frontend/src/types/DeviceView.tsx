export interface QuickLink {
    link: { url: string; title: string; target: string }
}

export interface Devices {
    deviceName: { url: string; title: string; target: string }
    icon: { src: string; alt: string };
}

export interface DeviceView {
    title: string;
    subtitle: string;
    inputPlaceholder: string;
    quickLinks: QuickLink[];
    devices: Devices[];
}
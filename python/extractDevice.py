import csv

def extract_desktop_rows(input_csv, output_csv):
    with open(input_csv, 'r', newline='', encoding='utf-8') as infile, \
         open(output_csv, 'w', newline='', encoding='utf-8') as outfile:

        reader = csv.DictReader(infile)
        fieldnames = reader.fieldnames

        writer = csv.DictWriter(outfile, fieldnames=fieldnames)
        writer.writeheader()

        for row in reader:
            if row.get('type', '').strip().lower() == 'desktop':
                writer.writerow(row)

    print(f"Extracted rows saved to {output_csv}")

# Example usage
extract_desktop_rows('devices.csv', 'desktops_only.csv')

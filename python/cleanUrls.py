import csv

def clean_url_column(input_csv, output_csv):
    with open(input_csv, 'r', newline='', encoding='utf-8') as infile, \
         open(output_csv, 'w', newline='', encoding='utf-8') as outfile:

        reader = csv.DictReader(infile)
        fieldnames = reader.fieldnames
        writer = csv.DictWriter(outfile, fieldnames=fieldnames)
        writer.writeheader()

        for row in reader:
            original_url = row['url']
            parts = original_url.split('/', 2)  # split by "/" max 2 times
            row['url'] = parts[2] if len(parts) > 2 else original_url
            writer.writerow(row)

    print(f"Cleaned CSV saved to {output_csv}")

# Example usage:
clean_url_column('laptops_only.csv', 'output.csv')
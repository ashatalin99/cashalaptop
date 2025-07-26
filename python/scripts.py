import csv

def add_brand_column_from_title(input_csv, output_csv):
    with open(input_csv, 'r', newline='', encoding='utf-8') as infile, \
         open(output_csv, 'w', newline='', encoding='utf-8') as outfile:

        reader = csv.DictReader(infile)
        fieldnames = reader.fieldnames

        if 'title' not in fieldnames or 'type' not in fieldnames:
            raise ValueError("CSV must contain 'title' and 'type' columns")

        # Insert 'brand' column right after 'type'
        new_fieldnames = []
        for field in fieldnames:
            new_fieldnames.append(field)
            if field == 'type':
                new_fieldnames.append('brand')

        writer = csv.DictWriter(outfile, fieldnames=new_fieldnames)
        writer.writeheader()

        for row in reader:
            brand = row['title'].split()[0] if row['title'] else ''
            new_row = {}

            for key in fieldnames:
                new_row[key] = row[key]
                if key == 'type':
                    new_row['brand'] = brand

            writer.writerow(new_row)

    print(f"Updated CSV with 'brand' column saved to {output_csv}")

# Example usage
#add_brand_column_from_title('watches.csv', 'watches_with_brand.csv')


def replace_first_dash_with_slash(input_csv, output_csv):
    with open(input_csv, 'r', newline='', encoding='utf-8') as infile, \
         open(output_csv, 'w', newline='', encoding='utf-8') as outfile:

        reader = csv.DictReader(infile)
        fieldnames = reader.fieldnames
        writer = csv.DictWriter(outfile, fieldnames=fieldnames)
        writer.writeheader()

        for row in reader:
            url = row.get('url', '')
            if '-' in url:
                row['url'] = url.replace('-', '/', 1)
            writer.writerow(row)

    print(f"Updated URLs saved to {output_csv}")

# Example usage
# replace_first_dash_with_slash('watches_with_brand.csv', 'updated_watches.csv')


import csv
import requests
from bs4 import BeautifulSoup

BASE_URL = "https://cashalaptop.com/sell/"

def fetch_image_sources(full_url):
    try:
        response = requests.get(full_url, timeout=30)
        response.raise_for_status()
        soup = BeautifulSoup(response.text, 'html.parser')
        images = soup.select('#contentQuote img')
        return [img['src'] for img in images if img.get('src')]
    except Exception as e:
        print(f"Error fetching {full_url}: {e}")
        return []

def process_csv(input_csv, output_csv):
    with open(input_csv, 'r', newline='', encoding='utf-8') as infile, \
         open(output_csv, 'w', newline='', encoding='utf-8') as outfile:

        reader = csv.DictReader(infile)
        fieldnames = reader.fieldnames.copy()

        # Insert 'images' column after 'url'
        url_index = fieldnames.index('url')
        fieldnames.insert(url_index + 1, 'images')

        writer = csv.DictWriter(outfile, fieldnames=fieldnames)
        writer.writeheader()

        for row in reader:
            type_val = row.get('type', '').strip()
            url_val = row.get('url', '').strip()

            if not type_val or not url_val:
                row['images'] = []
                writer.writerow(row)
                continue

            full_url = f"{BASE_URL}{type_val}/{url_val}"
            image_sources = fetch_image_sources(full_url)
            row['images'] = image_sources
            writer.writerow(row)

    print(f"Updated CSV with image URLs saved to {output_csv}")

# Example usage
# process_csv('watches.csv', 'watches_with_images.csv')

import csv
import re

import csv
import re

def clean_url_and_images(input_csv, output_csv):
    with open(input_csv, 'r', newline='', encoding='utf-8') as infile, \
         open(output_csv, 'w', newline='', encoding='utf-8') as outfile:

        reader = csv.DictReader(infile)
        fieldnames = reader.fieldnames
        writer = csv.DictWriter(outfile, fieldnames=fieldnames)
        writer.writeheader()

        for row in reader:
            # Clean URL: remove everything before first "/"
            url = row.get('url', '')
            if '/' in url:
                row['url'] = url.split('/', 1)[1]

            # Clean images: remove substring from "_" to last "/", and then remove first "/"
            images = row.get('images', '')
            cleaned_images = []

            for img in images.split(','):
                img = img.strip()

                # Remove from "_" to last "/" (including that "/")
                match = re.search(r'_(.*)/', img)
                if match:
                    to_remove = match.group(0)
                    img = img.replace(to_remove, '')

                # Remove leading slash if present
                if img.startswith('/'):
                    img = img[1:]

                cleaned_images.append(img)

            row['images'] = ','.join(cleaned_images)
            writer.writerow(row)

    print(f"Cleaned CSV saved to {output_csv}")

# Example usage




# Example usage
# clean_url_and_images('desktops.csv', 'cleaned_desktops.csv')
# clean_url_and_images('phones.csv', 'cleaned_phones.csv')
# clean_url_and_images('tablets.csv', 'cleaned_tablets.csv')
# clean_url_and_images('watches.csv', 'cleaned_watches.csv')
# clean_url_and_images('all-in-one.csv', 'cleaned_all-in-one.csv')


import csv
import ast

def clean_images_column(input_csv, output_csv):
    with open(input_csv, 'r', newline='', encoding='utf-8') as infile, \
         open(output_csv, 'w', newline='', encoding='utf-8') as outfile:

        reader = csv.DictReader(infile)
        fieldnames = reader.fieldnames
        writer = csv.DictWriter(outfile, fieldnames=fieldnames)
        writer.writeheader()

        for row in reader:
            raw_images = row.get('images', '')

            cleaned_images = []

            try:
                # Safely evaluate the string as a list
                img_list = ast.literal_eval(raw_images)
                for img in img_list:
                    img = img.lstrip('/')  # Remove leading slash
                    cleaned_images.append(img)
            except Exception:
                # Fallback in case of malformed string
                cleaned_images = [raw_images.strip("[]'\"")]

            row['images'] = ','.join(cleaned_images)
            writer.writerow(row)

    print(f"Cleaned images saved to {output_csv}")

# Example usage
clean_images_column('desktops.csv', 'cleaned_desktops.csv')
clean_images_column('watches.csv', 'cleaned_watches.csv')
clean_images_column('phones.csv', 'cleaned_phones.csv')
clean_images_column('tablets.csv', 'cleaned_tablets.csv')
clean_images_column('all-in-one.csv', 'cleaned_all-in-one.csv')

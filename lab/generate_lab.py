import argparse
from os import listdir
from os.path import isfile, join
import string

SLIDE_TEMPLATE = """
		<div id="slide-SLIDE_NUMBER" class="row lab-slide">
			<img src="SLIDE_IMAGE" class="img-responsive col-md-6" title="SLIDE_NUMBER" />
			<div class="col-md-6">
				<!-- <h3>Video</h3> -->
				<!-- <h3>Links</h3> -->
				<!-- <h3>Code</h3> -->
				<!-- <h3>Debug</h3> -->
			</div>
		</div>
"""

TEMPLATE_CONTENT = "<!-- CONTENT -->"

def writeLabPage(directory, slide_images):
	with open ("template.html", "r") as template:
		page = template.read()
		if len(page) == 0:
			raise Error("Cannot find template file template.html.")

	slides = []
	for index, slide_image in enumerate(slide_images):
		print(index)
		slide_template = string.replace(SLIDE_TEMPLATE, "SLIDE_NUMBER", str(index+1))
		slide_template = string.replace(slide_template, "SLIDE_IMAGE", slide_image)
		slides.append(slide_template)

	slide_html = '\n'.join(slides)
	page = string.replace(page, TEMPLATE_CONTENT, slide_html)
	with open(directory + '/index.html', 'w') as out:
		out.write(page)
	print("Wrote " + directory + '/index.html')


if __name__ == "__main__":
	parser = argparse.ArgumentParser(description='Generate a lab template from slide images.')
	parser.add_argument('directory', help='directory containing the slide images')
	args = parser.parse_args()
	directory = args.directory

	slide_images = [ f for f in listdir(directory) if isfile(join(directory,f)) and f.lower().endswith('.png') ]
	print(str(len(slide_images)) + ' slides to process')

	if len(slide_images) > 0:
		writeLabPage(directory, slide_images)
	print("Done.")
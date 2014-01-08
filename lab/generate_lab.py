import argparse
from os import listdir
from os.path import isfile, join
import string
import json

SLIDE_TEMPLATE = u"""
  <div id="slide-SLIDE_NUMBER" class="row lab-slide">
    <div class="col-md-1">
      <h2>SLIDE_NUMBER</h2>
    </div>
    <img src="SLIDE_IMAGE" class="img-responsive col-md-6"
      title="SLIDE_NUMBER" />
    <div class="col-md-5">
      SLIDE_NOTES_STUB
    </div>
  </div>
"""


TEMPLATE_CONTENT = u"<!-- CONTENT -->"

def writeSlideNotes(notes_list):
  if not notes_list:
    return u""

  if not isinstance(notes_list, list):
    raise Exception("Non-List Note Object Found")

  gen_html = u""
  for n in notes_list:
    typ = n['type']
    title = None
    if 'title' in n:
      title = n['title']

    if   typ == 'video':
      if not title: title = 'Video'
      gen_html += u"""
      <div class="video">
        <h4>"""+title+u"""</h4>
        <video src='"""+n['src']+u"""' style='width:100%' controls preload="none" poster="../video-poster.jpg"></video>
      </div>
      """
    elif typ == 'links':
      if not title: title = 'Links'
      gen_html += u"""
      <div class="links">
        <h4>"""+title+u"""</h4>
        <ul>"""

      for line in n['list']:
        gen_html+=u"""
          <li>"""+line+u"</li>"

      gen_html+=u"""
        </ul>
      </div>
      """
    elif typ == 'code':
      if not title: title = 'Code'
      gen_html += u"""
      <div class="code">
        <h4>"""+title+u"""</h4>
        <pre class='pre-scrollable'><code>"""+n['text']+u"""</code></pre>
      </div>
      """
    elif typ == 'debug':
      if not title: title = 'Debug'
      gen_html += u"""
      <div class="debug">
        <h4>"""+title+u"""</h4>"""
      for issue in n['list']:
        gen_html += u"""
        <div class="well well-sm">
          <p class="lead">"""+issue['problem']+u"""</p>
          <p>"""+issue['fix']+u"""</p>
        </div>"""
      gen_html += u"""
      </div>
      """
    else:
      raise Exception('Unsupported Note Type: '+str(typ))

  return gen_html

def writeLabPage(directory, slide_images, slide_notes):
  with open ("template.html", "r") as template:
    page = unicode(template.read())
    if len(page) == 0:
      raise Error("Cannot find template file template.html.")



  slides = []
  for index, slide_image in enumerate(slide_images):
    print('writing slide row '+str(index+1))
    note_html = ''
    if index < len(slide_notes):
      note_html = writeSlideNotes(slide_notes[index])
    slide_template = string.replace(SLIDE_TEMPLATE,
                                    "SLIDE_NUMBER",
                                    str(index+1))
    slide_template = string.replace(slide_template,
                                    "SLIDE_IMAGE",
                                    slide_image)
    slide_template = string.replace(slide_template,
                                    "SLIDE_NOTES_STUB",
                                    note_html)
    # ensure good visual separation between notes for one slide and the next
    # when in two-column layout
    slide_template += u"<hr></hr>"

    slides.append(slide_template)


  #print('early_abort')
  #return

  slide_html = '\n'.join(slides)
  page = string.replace(page, TEMPLATE_CONTENT, slide_html)
  with open(directory + '/index.html', 'w') as out:
    out.write(page.encode('utf-8'))
  print("Wrote " + directory + '/index.html')


if __name__ == "__main__":
  parser = argparse.ArgumentParser(description=
                  'Generate a lab template from slide images.')
  parser.add_argument('directory', help=
                  'directory containing the slide images')
  args = parser.parse_args()
  directory = args.directory

  slide_images = [
    f for f in listdir(directory)
      if isfile(join(directory,f)) and f.lower().endswith('.png') or f.lower().endswith('.jpg') ]
  print(str(len(slide_images)) + ' slides to process')

  print('Trying to load notes from: '+directory+'/notes.json')
  slide_notes = json.load(open(directory+'/notes.json'))

  #slide_notes = [None] * len(slide_images)
  #for i in range(0,len(slide_images)):
  #  if str(i+1) in json_data:
  #    slide_notes[i] = json_data[str(i+1)]

  #print(isinstance(slide_notes, list))
  #print(isinstance(slide_notes[0], list))

  if len(slide_images) > 0:
    writeLabPage(directory, slide_images, slide_notes)
  print("Done.")
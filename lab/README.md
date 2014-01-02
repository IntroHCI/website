To generate a page for a lab, go into Keynote and export all slides (no animations) as PNG. Then, run "generate_lab.py dirname", where dirname is the name of the subdirectory where the exported slide images live. Finally, go in and hand-edit the HTML to add videos, debugging tips, and so on.


To embed HTML fragments in a <pre><code> block, you'll need to first escape all HTML characters. The easiest way is to do this using a python terminal:
import cgi
str = """
<div>this is the raw html code block</div>
"""
print(cgi.escape(str))
&lt;div&gt;this is the raw html code block&lt;/div&gt;
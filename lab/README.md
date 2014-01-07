To generate a page for a lab
---------------------
1. Go into Keynote and export all slides (no animations) as PNG into a subdirectory here. (e.g. 'lab1')
2. Create a "notes.json" file in this subdirectory.  Copy and Paste "example-notes.json" to get started.
3. Run "python generate_lab.py dirname", where dirname is the subdirectory you exported the PNGs to.
4. Now go back and edit "notes.json" to add material to the right hand column.  Re-run "generate_lab.py" after changes to update the HTML page.


To embed HTML fragments in a <pre><code> block
----------------------
You'll need to first escape all HTML characters. The easiest way is to do this using a python terminal:

    import cgi
    str = """
    <div>this is the raw html code block</div>
    """
    print(cgi.escape(str))
    &lt;div&gt;this is the raw html code block&lt;/div&gt;
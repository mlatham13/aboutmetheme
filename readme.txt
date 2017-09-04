================================================================================
             Release and Configuration Notes for aboutmetheme
             Release 1.0.0
================================================================================

The Beginning
-------------
To create initial content for aboutmetheme, create posts with the following
"post_name" (i.e. slug):
    * index (required) - The front page text for the site
    * contact (optional) - An introduction and/or additional contact information
                           for the contact page


Header and Footer Buttons
-------------------------
Buttons/links within the header and footer sections are added via the menus
titled header (Header Menu) and footer (Footer Menu), respectively. Simply edit
these menus to create the header and footer button/links.


Adding sections
---------------
When a post is displayed (specifically, when single.php is invoked), additional
content can be added by creating a file in the sections folder. The filename
is tied to the post by the post's "post_name" (i.e. slug), appended with
"-section".  For example, when post "javascript" is displayed, the file
sections/javascript-section.php is appended to the post's content.

To add sections for a post, add the php files /sections, with filename
<slug>-section.php.


Adding Color Themes
-------------------
Add the theme css file to /css/color-schemes, and add the file name (sans extension)
to $THEME_COLOR_OPTIONS in /php/amt-globals.php.

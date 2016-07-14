# mbox_view_search

This is a simple PHP script built to view and search mbox.txt files.  This was originally developed to aid the subscribers to the "Corvette Restoration and Preservation List" (CRPL) mailing list (http://www.corvette-resto.com/).

General design:

 * Every page:
   * Search form fields: find_str, start_date, end_date
 * Search results:
   * Header and link for each archived email found
     * Link to "View" page
   * Buttons:
     * Next: Show if more results possible
     * Prev: Show page of previous results

 * View page:
   * Show archived email contents
     * All email addresses redacted
  * Buttons:
    * Return: Return to search results page (link to "back" button)

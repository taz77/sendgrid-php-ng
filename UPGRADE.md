## Upgrading to version 2.0.0 from 1.x.x

Version 2.0.0 encompasses a switch to SendGrid's V3 API. The V3 API has
numerous changes that impacts how emails are constructed and sent to SendGrid.
The SMTPapi is no longer used. Significant changes were made to addressing and
attachments of messages. Please read the follow to understand the changes that
impact your use of this wrapper.

Method changes:
  - setDate() is no longer supported
  - Attachments now require you to set the mimetype and disposition

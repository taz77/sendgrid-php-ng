<?php
/**
 * Create the attachment object serialized for V3 API of SendGrid.
 *
 * @author Brady Owens
 * @package SendGrid
 *
 */

namespace SendGrid\Mail;


class Attachment implements \JsonSerializable {

  private $content;

  private $type;

  private $filename;

  private $disposition;

  private $content_id;

  /**
   * Base64 encoded content of the attachment.
   *
   * @param string $content
   */
  public function setContent($content) {
    $this->content = $content;
  }

  /**
   * Getter for content.
   *
   * @return string
   */
  public function getContent() {
    return $this->content;
  }

  /**
   * Set the mime file type.
   *
   * example: video/mpeg
   * example: application/zip
   *
   * @see https://developer.mozilla.org/en-US/docs/Web/HTTP/Basics_of_HTTP/MIME_types/Complete_list_of_MIME_types
   *
   * @param $type
   */
  public function setType($type) {
    $this->type = $type;
  }

  /**
   * Getter for type.
   *
   * @return string
   */
  public function getType() {
    return $this->type;
  }

  /**
   * The filename of the attachment.
   *
   * @param string $filename
   */
  public function setFilename($filename) {
    $this->filename = $filename;
  }

  /**
   * Getter for filename.
   *
   * @return string
   */
  public function getFilename() {
    return $this->filename;
  }

  /**
   * Set the content-disposition of the attachment. This is how it is displayed.
   * Defaults to "attachment" disposition
   *
   * @param string $disposition
   *  - "inline" or "attachment"
   */
  public function setDisposition($disposition) {
    $this->disposition = $disposition;
  }

  /**
   * Getter for disposition.
   *
   * @return string
   */
  public function getDisposition() {
    return $this->disposition;
  }

  /**
   * Unique ID of the attachment. Used for displaying attachments inline.
   *
   * @param string $content_id
   */
  public function setContentID($content_id) {
    $this->content_id = $content_id;
  }

  /**
   * Getter for content ID.
   *
   * @return string
   */
  public function getContentID() {
    return $this->content_id;
  }

  /**
   * Return the attachment in an array.
   *
   * @return array | NULL
   */
  public function jsonSerialize() {
    return array_filter(
      [
        'content' => $this->getContent(),
        'type' => $this->getType(),
        'filename' => $this->getFilename(),
        'disposition' => $this->getDisposition(),
        'content_id' => $this->getContentID(),
      ],
      function ($value) {
        return $value !== NULL;
      }
    ) ?: NULL;
  }
}
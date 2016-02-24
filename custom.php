<?php

function rpi_display_custom_element_set($record, $setElements) {
    $populatedElements = array();
    foreach ($setElements as $element) {
         if (is_array($element) && count($element) == 2) {
            $populatedElements[$element[1]]['texts'] = rpiGetElementText($record, $element[0], $element[1]);
        }
    }
    $html  = '';
    foreach ($populatedElements as $elementName => $elementInfo) {
        if (count($elementInfo['texts']) > 0) {
            $html .= '<div id="' . text_to_id(html_escape("$elementName")) . '" class="element">';
            $html .= '<h3>' . html_escape(__($elementName)) . '</h3>';
            foreach ($elementInfo['texts'] as $text) {
                $html .= '<div class="element-text">' . $text . '</div>';
            }
            $html .= '</div>';
        }
    }
    return $html;
}

/**
 * Retrieve the set of ElementText records that correspond to a given
 * element set and element. Copied from Metadata View Helper.
 *
 * @param Omeka_Record_AbstractRecord $record
 * @param string $elementSetName
 * @param string $elementName
 * @return array Set of ElementText records.
 */
function rpiGetElementText($record, $elementSetName, $elementName)
{
    $elementTexts = $record->getElementTexts($elementSetName, $elementName);
    // Lock the records so that they can't be accidentally saved back to the
    // database, since we are modifying their values directly at this point.
    // Also clone the record because otherwise it would be passed by
    // reference to all the display filters, which results in munged text.
    foreach ($elementTexts as $key => $textRecord) {
        $elementTexts[$key] = clone $textRecord;
        $textRecord->lock();
    }
    return $elementTexts;
}
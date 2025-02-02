<?php
/******************************************************************************
 *
 *  Copyright 2023 Paphus Solutions Inc.
 *
 *  Licensed under the Eclipse Public License, Version 1.0 (the "License");
 *  you may not use this file except in compliance with the License.
 *  You may obtain a copy of the License at
 *
 *      http://www.eclipse.org/legal/epl-v10.html
 *
 *  Unless required by applicable law or agreed to in writing, software
 *  distributed under the License is distributed on an "AS IS" BASIS,
 *  WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 *  See the License for the specific language governing permissions and
 *  limitations under the License.
 *
 ******************************************************************************/
class AvatarMedia extends Config
{
    public ?string $mediaId;
    public ?string $name;
    public ?string $type;
    public ?string $media;
    public ?string $emotions;
    public ?string $actions;
    public ?string $poses;
    public $hd;
    public $talking;

    public function parseXML($xml): void
    {
        parent::parseXML($xml);
        $xmlData = simplexml_load_string($xml);
        if ($xmlData === false) {
            echo "Failed loading XML: ";
            foreach (libxml_get_errors() as $error) {
                echo "<br>", $error->message;
            }
        }
        // else {
        //     print_r($xmlData);
        // }

        $this->mediaId = $xmlData->attributes()->mediaId;
        $this->name = $xmlData->attributes()->name;
        $this->type = $xmlData->attributes()->type;
        $this->media = $xmlData->attributes()->media;
        $this->emotions = $xmlData->attributes()->emotions;
        $this->actions = $xmlData->attributes()->actions;
        $this->poses = $xmlData->attributes()->poses;
        $this->hd = $xmlData->attributes()->hd;
        $this->talking = $xmlData->attributes()->talking;
    }

    public function toXML(): ?string
    {
        $writer .= "<avatar-media";
        $this->writeCredentails($writer);
        if (isset($this->mediaId)) {
            $writer .= " mediaId=\"" . $this->mediaId . "\"";
        }
        if (isset($this->mediaId)) {
            $writer .= " mediaId=\"" . $this->mediaId . "\"";
        }
        if (isset($this->type)) {
            $writer .= " type=\"" . $this->type . "\"";
        }
        if (isset($this->emotions)) {
            $writer .= " emotions=\"" . $this->emotions . "\"";
        }
        if (isset($this->actions)) {
            $writer .= " actions=\"" . $this->actions . "\"";
        }
        if (isset($this->poses)) {
            $writer .= " poses=\"" . $this->poses . "\"";
        }
        $writer .= " hd=\"" . $this->hd . "\"";
        $writer .= " hd=\"" . $this->talking . "\"";
        $writer .= "/>";
        return $writer;
    }

    public function isVideo () : bool {
        return isset($this->type) && strpos($this->type, 'video') !== false;
    }

    public function isAudio () : bool {
        return isset($this->type) && strpos($this->type, 'audio') !== false;
    }
}
?>
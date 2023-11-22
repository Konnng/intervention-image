<?php

namespace Intervention\Image\Drivers\Imagick\Modifiers;

use Intervention\Image\Drivers\DriverModifier;
use Intervention\Image\Drivers\Imagick\Frame;
use Intervention\Image\Interfaces\ImageInterface;

class PixelateModifier extends DriverModifier
{
    public function apply(ImageInterface $image): ImageInterface
    {
        foreach ($image as $frame) {
            $this->pixelateFrame($frame);
        }

        return $image;
    }

    protected function pixelateFrame(Frame $frame): void
    {
        $size = $frame->size();

        $frame->native()->scaleImage(
            round(max(1, ($size->width() / $this->size))),
            round(max(1, ($size->height() / $this->size)))
        );

        $frame->native()->scaleImage($size->width(), $size->height());
    }
}

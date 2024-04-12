<?php

namespace Felipetti\ServiceLayer\Helper;

use Illuminate\Support\Facades\File;

class StringHelper
{
    /**
     * Converts full path to local path.
     *
     * @param string $fullPath
     * @return string
     */
    public static function convertFullPathToLocalPath(string $fullPath): string
    {
        return str_replace(base_path() . '/', '', $fullPath);
    }

    /**
     * Replace forward to backslashes and first letter uppercase.
     *
     * @param string $path
     * @return string
     */
    public static function convertToFirstLetterUpperCaseAndBackSlash(string $path): string
    {
        return ucfirst(str_replace('/', '\\', $path));
    }

    /**
     * Builds the array to pass $this->call function, if needed.
     *
     * @param string $rawParameters
     * @return array
     * @noinspection PhpInconsistentReturnPointsInspection
     */
    public static function makeModelParameters(string $rawParameters): array
    {
        if(! str_contains($rawParameters,'-')) {
            $rawParameters = "-$rawParameters";
        }

        $parameters = collect(str_split($rawParameters));

        return $parameters->flatMap(function($parameter) use ($parameters)
        {
            if($parameter != '-') {
                return [$parameters->first() . $parameter => true];
            }
        })->toArray();
    }

    /**
     * Returns the proper path of the file, if it's published or not.
     *
     * @param string $publishPath
     * @param string $sourcePath
     * @return string
     */
    public static function getProperPath(string $publishPath, string $sourcePath): string
    {
        return File::exists($publishPath) ? $publishPath : $sourcePath;
    }
}

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>iFrame Module</title>
   
</head>
<body >
<div class="w-full  p-8 space-y-6 ">
        <div class="extra-config">
            <?php
            function convertToYouTubeEmbed($url) {
                if (strpos($url, 'youtube.com') !== false) {
                    parse_str(parse_url($url, PHP_URL_QUERY), $queryParams);
                    $videoId = $queryParams['v'];
                    return 'https://www.youtube.com/embed/' . $videoId;
                } else if (strpos($url, 'youtu.be') !== false) {
                    $videoId = substr(parse_url($url, PHP_URL_PATH), 1);
                    return 'https://www.youtube.com/embed/' . $videoId;
                }
                return $url;
            }

            $url = get_sub_field('url');

            if ($url) :
            ?>
            <div class="relative" style="padding-top: 56.25%;">
                <iframe src="<?php echo convertToYouTubeEmbed($url); ?>" frameborder="0" allowfullscreen class="absolute top-0 left-0 w-full h-full"></iframe>
            </div>
            <?php else : ?>
            <p>No URL found for iFrame.</p>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>

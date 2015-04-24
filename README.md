Contao News Image Override
=====================

Allows the image settings of each news entry in Contao to override the image settings of the news module.

_Note:_ this extension uses the `parseArticles` hook to achieve this behaviour. However, this also means that the image is processed two times, if there is an image size setting present in a news entry. Once in the module and a second time in the hook. This causes unnecessary processing time, which may increase the page load time if all the images have to be generated for the first time.

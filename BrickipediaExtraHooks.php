<?php
/**
 * This mini-extension adds <s>two links</s> one link, "Parents", to the page footer.
 * (The Terms of Use link is commented out because on ShoutWiki we've repurposed the
 * core MediaWiki "disclaimer" stuff for Terms of Use, so adding _another_ ToU link
 * from here would make no sense since one is already present.)
 *
 * In addition to that, all Brickipedia-specific i18n messages are contained
 * in this extension.
 *
 * @file
 * @date 2 November 2020
 */
class BrickipediaExtraHooks {

	/**
	 * @param Skin $skin
	 * @param string $key The current key for the current group (row) of footer links. Currently either info or places
	 * @param array &$footerLinks The array of links that can be changed.
	 *    Keys will be used for generating the ID of the footer item; values should be HTML strings.
	 */
	public static function onSkinAddFooterLinks( Skin $skin, string $key, array &$footerLinks ) {
		// "Terms of Use" link in footer
		/*
		if ( $key === 'places' ) {
			$footerLinks['termsofuse'] = $skin->footerLink( 'termsofuse', 'termsofusepage' );
		}
		*/

		// "Parents" link in footer
		// Just a lil' healthy dose of some old-fashioned paranoia...
		if ( $key === 'places' ) {
			$footerLinks['parents'] = $skin->footerLink( 'parents', 'parentspage' );
		}
	}
}

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
 * @date 1 March 2026
 */

use MediaWiki\Html\Html;
use MediaWiki\Title\Title;

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
			$footerLinks['termsofuse'] = self::footerLink( $skin, 'termsofuse', 'termsofusepage' );
		}
		*/

		// "Parents" link in footer
		// Just a lil' healthy dose of some old-fashioned paranoia...
		if ( $key === 'places' ) {
			$footerLinks['parents'] = self::footerLink( $skin, 'parents', 'parentspage' );
		}
	}

	/**
	 * Sporked from MW core includes/skin/Skin.php as of MW 1.39.
	 * The only real differences compared to the footerLink method there
	 * are that:
	 * - this also integrates the guts of the footerLinkTitle() method.
	 * - this method takes $skin as the 1st param instead of using $this
	 *
	 * @see https://phabricator.wikimedia.org/T326109
	 *
	 * Given a pair of message keys for link and text label,
	 * return an HTML link for use in the footer.
	 *
	 * @param Skin $skin
	 * @param string $desc The i18n message key for the link text.
	 * 		The content of this message will be the visible text label.
	 * 		If this is set to nonexisting message key or the message is
	 * 		disabled, the link will not be generated, empty string will
	 * 		be returned in the stead.
	 * @param string $page The i18n message key for the page to link to.
	 * 		The content of this message will be the destination page for
	 * 		the footer link. Given a message key 'Privacypage' with content
	 * 		'Project:Privacy policy', the link will lead to the wiki page with
	 * 		the title of the content.
	 *
	 * @return string HTML anchor
	 */
	public static function footerLink( $skin, $desc, $page ) {
		// If the link description has been disabled in the default language,
		if ( $skin->msg( $desc )->inContentLanguage()->isDisabled() ) {
			// then it is disabled, for all languages.
			return '';
		}

		// Otherwise, we display the link for the user, described in their
		// language (which may or may not be the same as the default language),
		// but we make the link target be the one site-wide page.
		$title = Title::newFromText( $skin->msg( $page )->inContentLanguage()->text() );
		if ( !$title ) {
			return '';
		}

		// Similar to Skin::addToSidebarPlain
		// Optimization: Avoid LinkRenderer here as it requires extra DB info
		// to add unneeded classes even for makeKnownLink (T313462).
		return Html::element( 'a',
			[ 'href' => $title->fixSpecialName()->getLinkURL() ],
			$skin->msg( $desc )->text()
		);
	}

}

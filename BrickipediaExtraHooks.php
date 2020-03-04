<?php
/**
 * This mini-extension adds two links to the page footer.
 * In addition to that, all Brickipedia-specific i18n messages are contained
 * in this extension.
 *
 * @file
 * @date 9 February 2017
 */
class BrickipediaExtraHooks {

	/**
	 * @param Skin $sk
	 * @param QuickTemplate &$tpl
	 * @return bool
	 */
	public static function onSkinTemplateOutputPageBeforeExec( $sk, &$tpl ) {
		// "Terms of Use" link in footer
		/*
		$tpl->set( 'termsofuse', $sk->footerLink( 'termsofuse', 'termsofusepage' ) );
		$tpl->data['footerlinks']['places'][] = 'termsofuse';
		*/

		// "Parents" link in footer
		$tpl->set( 'parents', $sk->footerLink( 'parents', 'parentspage' ) );
		$tpl->data['footerlinks']['places'][] = 'parents';

		return true;
	}
}

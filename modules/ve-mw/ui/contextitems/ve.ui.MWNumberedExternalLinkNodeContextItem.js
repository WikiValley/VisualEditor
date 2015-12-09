/*!
 * VisualEditor MWNumberedExternalLinkNodeContextItem class.
 *
 * @copyright 2011-2015 VisualEditor Team and others; see http://ve.mit-license.org
 */

/**
 * Context item for a MWNumberedExternalLinkNode.
 *
 * @class
 * @extends ve.ui.LinkContextItem
 *
 * @constructor
 * @param {ve.ui.Context} context Context item is in
 * @param {ve.dm.Model} model Model item is related to
 * @param {Object} config Configuration options
 */
ve.ui.MWNumberedExternalLinkNodeContextItem = function VeUiMWNumberedExternalLinkNodeContextItem() {
	// Parent constructor
	ve.ui.MWNumberedExternalLinkNodeContextItem.super.apply( this, arguments );

	// Initialization
	this.$element.addClass( 've-ui-mwNumberedExternalLinkNodeContextItem' );
};

/* Inheritance */

OO.inheritClass( ve.ui.MWNumberedExternalLinkNodeContextItem, ve.ui.LinkContextItem );

/* Static Properties */

ve.ui.MWNumberedExternalLinkNodeContextItem.static.name = 'link/mwNumberedExternal';

ve.ui.MWNumberedExternalLinkNodeContextItem.static.modelClasses = [ ve.dm.MWNumberedExternalLinkNode ];

/* Methods */

/**
 * @inheritdoc
 */
ve.ui.MWNumberedExternalLinkNodeContextItem.prototype.onClearButtonClick = function () {
	// Getting around the inheritance chain a bit here... this is a subclass of attribute
	// context, but in practice it's a regular node context. So, for consistency with other
	// links we still want the "clear attribute" button, but we want it to behave like the
	// remove-the-node button.
	return this.onDeleteButtonClick();
};

/* Registration */

ve.ui.contextItemFactory.register( ve.ui.MWNumberedExternalLinkNodeContextItem );

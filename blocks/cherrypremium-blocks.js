const { registerBlockType } = wp.blocks;
const { MediaUpload, RichText, InnerBlocks, InspectorControls, PanelColorSettings, URLInput } = wp.blockEditor;
const { ToggleControl, PanelBody, SelectControl, RadioControl, Button, TextControl } = wp.components;
const { createElement } = wp.element;

registerBlockType('cherrypremium/content', {
    title: 'Content',
    description: 'This content show content block',
    category: 'theme',
    icon: 'media-document',

    attributes: {
        setContainerClass: {type: 'string'},
        setHeadline: {type: 'string'},
        setContent: {type: 'string'},
        setBackgroundColor: {type: 'string'},
        setImage: {type: 'string'},
    },

    edit: function(props) {
        const {attributes: {setContainerClass, setHeadline, setContent, setBackgroundColor, setImage}, setAttributes, className} = props;

        const onSelectSetImage = media => {
            setAttributes({setImage: media.ul});
        }

        return (
            createElement('div', {className: `${className}`},
                createElement(InspectorControls, null,
                    createElement(PanelBody, {title: 'Settings'},
                        createElement(TextControl, {
                            label: 'Set the classes for the main container',
                            value: setContainerClass,
                            onChange: value => setAttributes({setContainerClass: value})
                        }),
                        createElement(TextControl, {
                            label: 'Set the background of this component',
                            value: setBackgroundColor,
                            onChange: value => setAttributes({setBackgroundColor: value})
                        }),
                    )
                ),
                createElement('div', {className: 'content'},
                    createElement(MediaUpload, {
                        onSelect: onSelectSetImage,
                        allowedTypes: ['image'],
                        value: setImage,
                        render: ({open}) => createElement(Button, {onClick: open}, 'Choose an image')
                    }),
                    createElement(RichText, {
                        tagName: 'h2',
                        placeholder: 'Eneter your headline here',
                        value: setHeadline,
                        onChange: value => setAttributes({setHeadline: value}),
                        keepPlaceholderOnFocus: true
                    }),
                    createElement(RichText, {
                        tagName: 'p',
                        placeholder: 'Enter your content here',
                        value: setContent,
                        onChange: value => setAttributes({setContent: value}),
                        keepPlaceholderOnFocus: true
                    }),
                )
            )
        )
    },

    save: function(props) {
        const {attributes: {setContainerClass, setHeadline, setContent, setBackgroundColor, setImage}} = props;

        return (
            createElement('div', {className: `content ${setContainerClass}`},
                createElement('div', {className: 'content__container-wrapper'},
                    createElement('div', {className: 'content__container-image'},
                        createElement('div', {src: setImage, className: 'content__img'})
                    ),
                    createElement('div', {className: 'content__container-title'},
                        createElement('h2', {className: 'content__title', dangerouslySetInnerHTML: { __html: setHeadline}})
                    ),
                    createElement('div', {className: 'content__container-content'},
                        createElement('p', {className: 'content__content', dangerouslySetInnerHTML: { __html: setContent}})
                    )
                )
            )
        )
    }
});

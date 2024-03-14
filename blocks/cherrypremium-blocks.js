const { registerBlockType } = wp.blocks;
const { MediaUpload, RichText, InnerBlocks, InspectorControls, PanelColorSettings, URLInput } = wp.blockEditor;
const { ToggleControl, PanelBody, SelectControl,RadioControl, Button } = wp.components;
const { createElement } = wp.element;

registerBlockType("cherrypremium/test", {
    title: "Test",
    icon: "magaphone",
    category: "common",
    
    attributes: {
        text: { type: "string" },
        backgroundColor: { type: "string" },
        iconUrl: { type: "string" }
    },

    edit: function(props) {
        const { attributes: { text, backgroundColor, iconUrl }, setAttributes, className } = props;

        const onSelectIcn = media => {
            setAttributes({ iconUrl: media.url });
        }

        return createElement("test-class", { className: `${className}` },
            createElement(RichText, {
                tagName: 'p',
                placeholder: 'Enter text here',
                value: text,
                onChange: (value) => setAttributes({ text: value }),
                keepPlaceholderOnFocus: true
            }),
        )
    },

    save: function(props) {
        const { text, backgroundColor, iconUrl } = props.attributes;

        return createElement('aside', { className: `test-class` },
            iconUrl && createElement('img', { src: iconUrl, className: `icon-${iconPosition}` }),
            createElement('div', { className: `${iconPosition} ${backgroundColor}` },
                createElement(RichText.Content, { tagName: 'p', value: text }),
                showButton && createElement('div', { className: 'callout-button' },
                    createElement(InnerBlocks.Content)
                )
            )
        );
    }
})
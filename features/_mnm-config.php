<?php
function mnm_get_features_settings_structure()
{
    return [
        'block_external_connections' => [
            'label' => 'Block External Connections',
            'type'  => 'checkbox',
            'description' => 'Enable to block external connections.',
            'fields' => [
                'is_active' => [
                    'label' => 'Enable',
                    'type'  => 'checkbox',
                ],
                'whitelist' => [
                    'label' => 'Whitelist (separated by new line)',
                    'type'  => 'textarea',
                    'description' => 'Addresses that should not be blocked.',
                ],
            ],
        ],
        'xml_rpc_deactivate' => [
            'label' => 'Block XML/RPC',
            'type'  => 'checkbox',
            'description' => 'Disables the XML/RPC interface',
            'fields' => [
                'is_active' => [
                    'label' => 'Enable',
                    'type'  => 'checkbox',
                ],
            ],
            'additional_html' => '<p>Insert the following code into your .htaccess to completely disable XML-RPC:</p><code>&lt;Files xmlrpc.php&gt;<br>Order Deny,Allow<br>Deny from all<br>&lt;/Files&gt;</code>'
        ],
        'block_wp_embed' => [
            'label' => 'Disable WP Embed Scripts',
            'type'  => 'checkbox',
            'description' => 'Disables WP Embed Scripts to speed up the site and increase security.',
            'fields' => [
                'is_active' => [
                    'label' => 'Enable',
                    'type'  => 'checkbox',
                ],
            ],
        ],
        'html_compression' => [
            'label' => 'HTML Compression',
            'type'  => 'checkbox',
            'description' => 'Enables HTML compression.',
            'fields' => [
                'is_active' => [
                    'label' => 'Enable',
                    'type' => 'checkbox',
                    'description' => 'Enables the compression of the HTML code.'
                ],
                'keep_whitespaces_between_tags' => [
                    'label' => 'Keep whitespace between tags',
                    'type' => 'checkbox',
                    'description' => 'Keeps white spaces between HTML tags'
                ],
                'compress_inline_css' => [
                    'label' => 'Inline CSS Compression',
                    'type' => 'checkbox',
                    'description' => 'Removes unnecessary white spaces in CSS within the HTML code.'
                ],
                'compress_inline_js' => [
                    'label' => 'Inline JS Compression',
                    'type' => 'checkbox',
                    'description' => 'Removes unnecessary white spaces in JavaScript within the HTML code.'
                ],
                'remove_comments' => [
                    'label' => 'Remove comments',
                    'type' => 'checkbox',
                    'description' => 'Removes HTML comments.'
                ],
                'info_comment' => [
                    'label' => 'Add info comment',
                    'type' => 'checkbox',
                    'description' => 'Adds a comment with information about the compression at the end of the HTML code.'
                ]
            ],
        ],
        'remove_emoji' => [
            'label' => 'Remove Emoji Scripts',
            'type'  => 'checkbox',
            'description' => 'Removes emoji scripts and styles from the frontend and admin area.',
            'fields' => [
                'is_active' => [
                    'label' => 'Enable',
                    'type'  => 'checkbox',
                ],
            ],
        ],
        'remove_inline_comment_style' => [
            'label' => 'Remove Inline Comment Styles',
            'type'  => 'checkbox',
            'description' => 'Removes inline styles added by the recent comments widget.',
            'fields' => [
                'is_active' => [
                    'label' => 'Disable',
                    'type'  => 'checkbox',
                ],
            ],
        ],
        'remove_wp_responsive_images' => [
            'label' => 'Disable Responsive Images',
            'type'  => 'checkbox',
            'description' => 'Disables the automatic addition of srcset and sizes attributes to images in content, to disable responsive images.',
            'fields' => [
                'is_active' => [
                    'label' => 'Disable',
                    'type'  => 'checkbox',
                ],
            ],
        ],
        'rss_feed_turn_off' => [
            'label' => 'Disable RSS Feeds',
            'description' => 'Control the availability of RSS feeds on your website.',
            'fields' => [
                'disable_message' => [
                    'label' => 'Disable Message',
                    'type'  => 'text',
                    'description' => 'Custom message to display when accessing a disabled feed.',
                    'default' => 'Feed not available. Please visit the homepage.',
                ],
                'do_feed' => [
                    'label' => 'Standard Feed',
                    'type'  => 'checkbox',
                ],
                'do_feed_rdf' => [
                    'label' => 'RDF Feed',
                    'type'  => 'checkbox',
                ],
                'do_feed_rss' => [
                    'label' => 'RSS Feed',
                    'type'  => 'checkbox',
                ],
                'do_feed_rss2' => [
                    'label' => 'RSS2 Feed',
                    'type'  => 'checkbox',
                ],
                'do_feed_atom' => [
                    'label' => 'Atom Feed',
                    'type'  => 'checkbox',
                ],
                'do_feed_rss2_comments' => [
                    'label' => 'RSS2 Comment Feed',
                    'type'  => 'checkbox',
                ],
                'do_feed_atom_comments' => [
                    'label' => 'Atom Comment Feed',
                    'type'  => 'checkbox',
                ],
            ],
        ],
        'heartbeat_api' => [
            'label' => 'Configure Heartbeat API',
            'description' => 'Adjust the settings of the Heartbeat API.',
            'fields' => [
                'heartbeat_frequency' => [
                    'label' => 'Heartbeat Frequency',
                    'type'  => 'number',
                    'description' => 'Set the interval in seconds at which the Heartbeat API is triggered.',
                    'default' => 60,
                    'attributes' => ['min' => 0, 'max' => 300, 'step' => 1],
                ],
                'disable_on_pages' => [
                    'label' => 'Disable on specific pages',
                    'type'  => 'checkbox',
                    'description' => 'Disable the Heartbeat API on all pages except post and page editing.',
                ],
            ],
        ],
        'tidy_up_wp_head' => [
            'label' => 'Tidy up WordPress Head',
            'description' => 'Select which elements should be removed from the WordPress head section.',
            'fields' => [
                'remove_rsd_link' => [
                    'label' => 'Remove RSD Links',
                    'type'  => 'checkbox',
                    'description' => 'Removes the RSD Link (Really Simple Discovery link).',
                ],
                'remove_wp_generator' => [
                    'label' => 'Remove WordPress Version',
                    'type'  => 'checkbox',
                    'description' => 'Removes the meta tag with the WordPress version.',
                ],
                'remove_index_rel_link' => [
                    'label' => 'Remove Index Relationship Link',
                    'type'  => 'checkbox',
                    'description' => 'Removes the index relationship link.',
                ],
                'remove_wlwmanifest_link' => [
                    'label' => 'Remove WLW Manifest Link',
                    'type'  => 'checkbox',
                    'description' => 'Removes the WLW (Windows Live Writer) Manifest Link.',
                ],
                'remove_feed_links' => [
                    'label' => 'Remove Feed Links',
                    'type'  => 'checkbox',
                    'description' => 'Removes the general feed links.',
                ],
                'remove_feed_links_extra' => [
                    'label' => 'Remove Extra Feed Links',
                    'type'  => 'checkbox',
                    'description' => 'Removes the extra feed links (categories, tags, etc.).',
                ],
                'remove_parent_post_rel_link' => [
                    'label' => 'Remove Parent Post Relationship Links',
                    'type'  => 'checkbox',
                    'description' => 'Removes the parent post relationship links.',
                ],
                'remove_start_post_rel_link' => [
                    'label' => 'Remove Start Post Relationship Links',
                    'type'  => 'checkbox',
                    'description' => 'Removes the start post relationship links.',
                ],
                'remove_adjacent_posts_rel_link_wp_head' => [
                    'label' => 'Remove Previous/Next Post Relationship Links',
                    'type'  => 'checkbox',
                    'description' => 'Removes the links to the previous and next posts.',
                ],
                'remove_wp_shortlink_wp_head' => [
                    'label' => 'Remove WordPress Shortlink',
                    'type'  => 'checkbox',
                    'description' => 'Removes the WordPress shortlink from the head section.',
                ],
            ],
        ],

    ];
}

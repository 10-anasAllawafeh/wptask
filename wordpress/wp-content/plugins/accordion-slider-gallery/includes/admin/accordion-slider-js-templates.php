<script type="text/html" id="tmpl-accordion-slider-image">
    <div class="accordion-slider-single-image-content {{data.orientation}}" <# if ( data.full != '' ) { #> style="background-image:url({{ data.thumbnail }})" <# } #> >
        <?php do_action( 'accordion_admin_slider_image_start' ) ?>
        <# if ( data.thumbnail != '' ) { #>
            <img src="{{ data.thumbnail }}">
        <# } #>
        <div class="actions">
            <?php do_action( 'accordion_admin_slider_image_before_actions' ) ?>
            <a href="#" class="accordion-slider-edit-image" title="<?php esc_attr_e( 'Edit Image', 'accordion-slider' ) ?>"><span class="dashicons dashicons-edit"></span></a>
            <?php do_action( 'accordion_admin_slider_image_after_actions' ) ?>
            <a href="#" class="accordion-slider-delete-image" title="<?php esc_attr_e( 'Delete Image', 'accordion-slider' ) ?>"><span class="dashicons dashicons-trash"></span></a>
        </div>
        <div class="segrip ui-resizable-handle ui-resizable-se"></div>
        <?php do_action( 'accordion_admin_slider_image_end' ) ?>
    </div>
</script>

<script type="text/html" id="tmpl-accordion-slider-image-editor">
    <div class="edit-media-header">
        <button class="left dashicons"><span class="screen-reader-text"><?php esc_html_e( 'Edit previous media item', 'accordion-slider' ); ?></span></button>
        <button class="right dashicons"><span class="screen-reader-text"><?php esc_html_e( 'Edit next media item', 'accordion-slider' ); ?></span></button>
    </div>
    <div class="media-frame-title">
        <h1><?php esc_html_e( 'Edit Metadata', 'accordion-slider' ); ?></h1>
    </div>
    <div class="media-frame-content">
        <div class="attachment-details save-ready">
            <!-- Left -->
            <div class="attachment-media-view portrait">
                <div class="thumbnail thumbnail-image">
                    <img class="details-image" src="{{ data.full }}" draggable="false" />
                </div>
            </div>
            
            <!-- Right -->
            <div class="attachment-info">
                <!-- Settings -->
                <div class="settings">
                    <!-- Attachment ID -->
                    <input type="hidden" name="id" value="{{ data.id }}" />
                    
                    <!-- Image Title -->
                    <label class="setting">
                        <span class="name"><?php esc_html_e( 'Title', 'accordion-slider' ); ?></span>
                        <input type="text" name="title" value="{{ data.title }}" />
                        <div class="description">
                            <?php esc_html_e( 'Image titles can take any type of HTML.', 'accordion-slider' ); ?>
                        </div>
                    </label>
                  
                    
                    <!-- Caption Text -->
                    <label class="setting">
                        <span class="name"><?php esc_html_e( 'Caption Text', 'accordion-slider' ); ?></span>
                        <textarea name="description">{{ data.description }}</textarea>
                        <div class="description">
                        </div>
                    </label>
           

                    <!-- Addons can populate the UI here -->
                    <div class="accordion-slider-addons"></div>
                </div>
                <!-- /.settings -->     
               
                <!-- Actions -->
                <div class="actions">
                    <a href="#" class="accordion-slider-gallery-meta-submit button media-button button-large button-primary media-button-insert" title="<?php esc_attr_e( 'Save Metadata', 'accordion-slider' ); ?>">
                        <?php esc_html_e( 'Save', 'accordion-slider' ); ?>
                    </a>
                    <a href="#" class="accordion-slider-gallery-meta-submit-close button media-button button-large media-button-insert" title="<?php esc_attr_e( 'Save & Close', 'accordion-slider' ); ?>">
                        <?php esc_html_e( 'Save & Close', 'accordion-slider' ); ?>
                    </a>

                    <!-- Save Spinner -->
                    <span class="settings-save-status">
                        <span class="spinner"></span>
                        <span class="saved"><?php esc_html_e( 'Saved.', 'accordion-slider' ); ?></span>
                    </span>
                </div>
                <!-- /.actions -->
            </div>
        </div>
    </div>
</script>
<?php
/**
 * Template part for displaying the resources module.
 *
 * @package YourThemeName
 */

if ( function_exists( 'get_sub_field' ) ) {

    $resource_category_id = get_sub_field( 'resource_category' );
    $resource_selection_type = get_sub_field( 'resource_selection_type' );
    $resources = array();
    $category_title = '';

    // Fetch category title
    $term = get_term($resource_category_id, 'resource_category');
    if ($term && !is_wp_error($term)) {
        $category_title = $term->name;
    }

    if ( $resource_selection_type === 'Latest' ) {
        $resources_query = new WP_Query( array(
            'post_type'      => 'resources',
            'posts_per_page' => 7,
            'tax_query'      => array(
                array(
                    'taxonomy' => 'resource_category',
                    'field'    => 'term_id',
                    'terms'    => $resource_category_id,
                ),
            ),
        ) );

        if ( $resources_query->have_posts() ) {
            while ( $resources_query->have_posts() ) {
                $resources_query->the_post();
                $resources[] = array(
                    'id'                => get_the_ID(),
                    'title'             => get_the_title(),
                    'description'       => get_the_excerpt(),
                    'additional_desc'   => get_post_meta(get_the_ID(), '_additional_description', true),
                );
            }
            wp_reset_postdata();
        } else {
            echo '<p>No resources found for the latest category.</p>'; 
        }
    } elseif ( $resource_selection_type === 'Manual' ) {
        $manual_resources = get_sub_field( 'select_resources' );

        if ( $manual_resources ) {
            foreach ( $manual_resources as $resource ) {
                $resources[] = array(
                    'id'                => $resource->ID,
                    'title'             => $resource->post_title,
                    'description'       => $resource->post_excerpt,
                    'additional_desc'   => get_post_meta($resource->ID, '_additional_description', true),
                );
            }
        } else {
            echo '<p>No manually selected resources found.</p>'; 
        }
    }

    if ( ! empty( $resources ) ) {
            echo '<div class="container mx-auto resources-container py-8 px-4 flex justify-center w-auto">';
            echo '<div class="resources-module">';
            echo '<h4 class="resources-title">' . esc_html( $category_title ) . '</h4>'; 
            echo '<div class="resource-wrapper">';

        foreach ( $resources as $resource ) {
            echo '<div class="resource" data-id="' . esc_attr( $resource['id'] ) . '">';
            echo '<h3>' . esc_html( $resource['title'] ) . '</h3>';
            echo '<div class="additional-description">' . wpautop( $resource['additional_desc'] ) . '</div>';
            echo '<span class="open-arrow" data-id="' . esc_attr( $resource['id'] ) . '">&gt;</span>'; 
            echo '</div>';
            echo '<div id="modal-' . esc_attr( $resource['id'] ) . '" class="modal">';
            echo '<div class="modal-content">';
            echo '<button class="modal-close" aria-label="Close modal">&times;</button>';
            echo '<h2>' . esc_html( $resource['title'] ) . '</h2>'; 
            echo '<h6>Description</h6>'; 
            echo '<div class="description">' . wpautop( $resource['description'] ) . '</div>';
            echo '</div>';
            echo '</div>';
        }

        echo '</div>'; 
        echo '</div>'; 
    } else {
        echo '<p>No resources to display.</p>'; 
    }

} else {
    echo '<p>ACF is not active.</p>'; 
}
?>

<style>
    .resources-title {
    font-size: 16px;
    line-height: 24px;
    font-weight: bold;
    color: #333;
    margin-bottom: 5px;
    margin-left: 5px;
    /* padding: 2px; */
    border-bottom: #1F1048;
    width: 500px;
}

/* Style for the entire resource module */
.resources-module {
    display: flex;
    flex-direction: column;
    gap: 10px;
    padding: 14px 14px;
    width: 100%;
    height: auto; /* Adjusted to fit content */
    /* top: 33px; */
    /* left: 1px; */
    border-radius: 15px;
    font-family: 'Arial', sans-serif;
}

/* Style for each resource */
.resource {
    display: flex;
    flex-direction: column;
    background-color: #fff;
    padding: 14px 14px;
    border: 1px solid #e0e0e0;
    border-radius: 5px;
    transition: box-shadow 0.3s ease-in-out, transform 0.3s ease-in-out;
    cursor: pointer;
    width: 100%;
    position: relative; /* For positioning the arrow */
}

/* Title of each resource */
.resource h3 {
    font-size: 14px;
    font-weight: bold;
    color: rgba(31, 16, 72, 1);
    padding-bottom: 5px;
    line-height: 20px;
}

/* Additional description of each resource */
.additional-description {
    font-size: 12px;
    color: rgba(97, 91, 113, 1);
    font-weight: 400;
    line-height: 16px;
    /* margin-bottom: 10px; */
}

/* Arrow to open modal */
.open-arrow {
    font-size: 20px;
    color: rgba(100, 86, 143, 1);
    cursor: pointer;
    position: absolute;
    right: 24px; /* Align to the right end */
    top: 50%;
    transform: translateY(-50%); /* Vertically center the arrow */
}

.open-arrow:hover {
    color: #2980b9;
}

/* Modal styling */
.modal {
    display: none;
    position: fixed;
    z-index: 1000;
    right: 0;
    top: 2%;
    width: 25%;
    max-width: 350px;
    height: 100%;
    background-color: #ffffff;
    overflow-y: auto;
    transition: transform 0.3s ease-in-out, opacity 0.3s ease-in-out;
    transform: translateX(100%);
    opacity: 0;
}

.modal.show {
    display: block;
    transform: translateX(0);
    opacity: 1;
}

.modal-content {
    padding: 20px;
    position: relative;
    color: #333;
    font-size: 14px;
    line-height: 20px;
}

.modal-content h2 {
    margin-top: 5%;
    margin-bottom: 25px;
    font-size: 24px;
    color: #2c3e50;
    font-weight: 400;
    line-height: 32px;
}

/* Description styling */
.modal-content .description {
    margin-bottom: 15px;
    margin-top: 10px;
    font-size: 14px;
    color: #1F1048;
    font-weight: 400;
    line-height: 20px;
}

/* Close button styling inside the modal */
.modal .modal-close {
    position: absolute;
    top: 35px; /* Adjust as needed */
    right: 20px; /* Adjust as needed */
    background-color: transparent;
    border: none;
    color: #333;
    font-size: 36px; /* Increased size */
    cursor: pointer;
    padding: 5px;
}

.modal .modal-close:hover,
.modal .modal-close:focus {
    color: #000;
}

/* Remove overlay styles and the close button within it */
.modal-overlay {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: #00000052;
    z-index: 999;
}

.modal-overlay.show {
    display: block;
}

@media (max-width: 768px) {
    .resources-title {
        font-size: 14px;
        margin-left: 15px;
        padding-bottom: 5px;
        width: auto;
    }

    .resources-module {
        padding: 15px;
        width: 100%;
        height: auto;
    }

    .resource {
        padding: 15px;
        width: 100%;
        height: auto;
    }

    .resource h3 {
        font-size: 16px;
    }

    .additional-description {
        font-size: 12px;
    }

    .open-arrow {
        font-size: 18px;
    }

    .modal {
        width: 80%;
        right: 0;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    var resources = document.querySelectorAll('.resource');
    var modals = document.querySelectorAll('.modal');
    var overlay = document.createElement('div');
    overlay.classList.add('modal-overlay');
    document.body.appendChild(overlay);

    resources.forEach(function(resource) {
        resource.addEventListener('click', function() {
            var id = this.getAttribute('data-id');
            var modal = document.getElementById('modal-' + id);
            if (modal) {
                modal.classList.add('show');
                overlay.classList.add('show');
            }
        });
    });

    var closeButtons = document.querySelectorAll('.modal-close');
    closeButtons.forEach(function(button) {
        button.addEventListener('click', function() {
            modals.forEach(function(modal) {
                modal.classList.remove('show');
            });
            overlay.classList.remove('show');
        });
    });

    overlay.addEventListener('click', function() {
        modals.forEach(function(modal) {
            modal.classList.remove('show');
        });
        overlay.classList.remove('show');
    });

    var openArrows = document.querySelectorAll('.open-arrow');
    openArrows.forEach(function(arrow) {
        arrow.addEventListener('click', function(e) {
            e.stopPropagation();
            var id = this.getAttribute('data-id');
            var modal = document.getElementById('modal-' + id);
            if (modal) {
                modal.classList.add('show');
                overlay.classList.add('show');
            }
        });
    });
});
</script>
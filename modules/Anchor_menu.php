<?php

$module_title = get_field('anchor_menu'); 


if ($module_title) {
    echo '<div id="anchor">';
    echo '<h2>' . esc_html($module_title) . '</h2>'; 
    echo '</div>';
} else {
    echo '<div id="anchor">';
    echo '<h2>Table of Contents</h2>'; 
    echo '</div>';
}
?>

<script>
window.addEventListener('load', function() {
    function createAnchorMenu() {
        const sections = document.querySelectorAll('.module-container h2 [id], .module-container h2[id]');
        const anchorDiv = document.getElementById('anchor');
        
        if (!anchorDiv) {
            console.error('Anchor div not found');
            return;
        }

        let anchorHTML = '<ul>';
        sections.forEach(section => {
            const id = section.id;
            anchorHTML += `<li><a href="#${id}">${id}</a></li>`;
        });
        anchorHTML += '</ul>';

        anchorDiv.innerHTML += anchorHTML;
    }

    createAnchorMenu();
});
</script>


<style>
#anchor {
    width: 80%;
    max-width: 600px;
    margin: 0 auto 90px;
    border: 1px solid #ddd;
    border-radius: 10px;
    padding: 20px;
    background-color: #f9f9f9;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

#anchor h2 {
    margin-top: 0; 
    margin-bottom: 20px; /* Hapësirë nën titullin */
    font-size: 20px; /* Madhësia e titullit */
    color: black; /* Ngjyra e titullit */
    font-weight: bold;
}

#anchor ul {
    list-style: none; /* Heqim stilin default të listës */
    margin: 0;
    padding: 0;
    display: flex;
    flex-direction: column;
    gap: 10px;
}

#anchor li {
    padding: 10px;
    position: relative; /* Pozicioni relativ për të pozicionuar pikën */
    display: flex;
    align-items: center; /* Pozicionon pikat dhe tekstin në qendër vertikalisht */
}

#anchor li::before {
    content: '•'; /* Pika përpara çdo ID */
    position: absolute;
  
    color: black; /* Ngjyra e pikës */
    font-size: 20px; /* Madhësia e pikës */
    line-height: 1; /* Siguron që pika të jetë në mes të linjës së tekstit */
}

#anchor a {
    text-decoration: none;
    color: black;  
    font-weight: semibold;
    display: block;
    padding-left: 20px; /* Shtojmë hapësirë të mjaftueshme për të mos u mbuluar nga pika */
}

#anchor a:hover {
    text-decoration: underline;
    color: #007BFF;
}
</style>
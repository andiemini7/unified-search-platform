<?php if (have_rows('faq')) : ?>
    <div class="container mx-auto faq-container py-8 px-4 flex justify-center w-auto">
        <div class="faq-content">
            <!-- Left Column: Frequently Asked Questions -->
            <div class="faq-left-column">
                <h2 class="faq-title">Frequently Asked Questions</h2>
                <div class="faq-list">
                    <?php while (have_rows('faq')) : the_row(); 
                        $faq_question = get_sub_field('question');
                        $faq_answer = get_sub_field('answer');
                    ?>
                        <div class="faq-item">
                            <?php if (!empty($faq_question)) : ?>
                                <div class="faq-question">
                                    <span class="question-text"><?php echo esc_html($faq_question); ?></span>
                                    <span class="toggle-icon">+</span>
                                </div>
                            <?php endif; ?>
                            <?php if (!empty($faq_answer)) : ?>
                                <div class="faq-answer hidden">
                                    <?php echo wp_kses_post($faq_answer); ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    <?php endwhile; ?>
                </div>
            </div>
            
            <!-- Right Column: Image -->
            <div class="faq-right-column">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/man-thinking.jpg" alt="a man thinking" class="faq-image">
            </div>
        </div>
    </div>
<?php endif; ?>


<script>
    document.addEventListener('DOMContentLoaded', function() {
        const faqItems = document.querySelectorAll('.faq-item');

        faqItems.forEach(item => {
            const question = item.querySelector('.faq-question');
            const answer = item.querySelector('.faq-answer');

            question.addEventListener('click', () => {
                const currentlyOpen = document.querySelector('.faq-answer:not(.hidden)');
                if (currentlyOpen && currentlyOpen !== answer)  {
                    currentlyOpen.classList.add('hidden');
                    currentlyOpen.parentElement.querySelector('.toggle-icon').textContent = '+';
                }
                answer.classList.toggle('hidden');
                question.querySelector('.toggle-icon').textContent = answer.classList.contains('hidden') ? '+' : '-';
            });
        });
    });
</script>

<style>
    body {
        background-color: #ffffff;
        font-family: Arial, sans-serif;
    }

    .faq-container {
        max-width: 100%; 
        margin: 20px; 
        background-color: #ffffff;
        border-radius: 10px;
        overflow: hidden;
       
    }

    .faq-content {
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between;
        align-items: center;
    }

    .faq-left-column {
        flex: 1;
        padding: 20px;
    }

    .faq-title {
        font-size: 2rem;
        font-weight: bold;
        margin-bottom: 30px; 
        color: #333333;
        text-align: center; 
    }

    .faq-list {
        margin-top: 20px;
    }

    .faq-item {
        margin-bottom: 20px; 
    }

    .faq-question {
        display: flex; 
        justify-content: space-between; 
        align-items: center; 
        width: 100%;
        padding: 15px;
        background-color: #ffffff;
        border: none;
        border-bottom: 1px solid #e0e0e0;
        text-align: left;
        font-size: 1.2rem;
        color: #000000;
        cursor: pointer;
        transition: background-color 0.3s;
    }

    .faq-question:hover {
        background-color: #f8f8f8;
    }

    .faq-answer {
        display: none;
        padding: 15px;
        font-size: 1rem; 
        color: #555555;
    }

    .faq-answer.hidden {
        display: none;
    }

    .faq-answer:not(.hidden) {
        display: block;
    }

    .faq-right-column {
        display: block; 
        flex: 1;
        padding: 20px;
        text-align: center;
    }

    .faq-image {
        max-width: 100%;
        height: auto; 
        border-radius: 10px;
    }

    .toggle-icon {
        font-size: 1.5rem; 
        margin-left: 80px; 
        transition: transform 0.3s;
    }

    .faq-answer:not(.hidden) ~ .faq-question .toggle-icon {
        transform: rotate(45deg);
    }

    @media (max-width: 768px) {
        .faq-container {
            border-radius: 0; 
            margin: 0; 
        }

        .faq-content {
            flex-direction: column;
        }

        .faq-left-column, .faq-right-column {
            flex: auto; 
            padding: 10px; /
        }

        .faq-title {
            margin-bottom: 20px; 
        }

        .faq-question {
            font-size: 1.2rem; 
            margin-bottom: 10px; 
        }

        .faq-answer {
            font-size: 1rem; 
            margin-bottom: 20px; 
        }

        .toggle-icon {
            font-size: 1.2rem; 
        }

        .faq-image {
            display: none; 
        }
    }
</style>

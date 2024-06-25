<?php if (have_rows('faq')) : ?>
    <div class="w-full flex flex-col md:flex-row py-8">
        <!-- Left Column: Frequently Asked Questions -->
        <div class="w-full md:w-1/4 p-4 border-r border-gray-300">
            <h2 class="text-3xl mb-4">Frequently Asked Questions</h2>
        </div>

        <!-- Right Column: Questions and Answers -->
        <div class="w-full md:w-3/4 p-4">
            <div class="faq-list">
                <?php while (have_rows('faq')) : the_row(); 
                    $faq_question = get_sub_field('question');
                    $faq_answer = get_sub_field('answer');
                ?>
                    <div class="faq-item mb-4 border-b border-gray-300">
                        <?php if (!empty($faq_question)) : ?>
                            <button class="faq-question text-lg w-full text-left p-4 bg-white text-black cursor-pointer focus:outline-none transition duration-300 ease-in-out hover:bg-gray-100">
                                <?php echo esc_html($faq_question); ?>
                            </button>
                        <?php endif; ?>
                        <?php if (!empty($faq_answer)) : ?>
                            <div class="faq-answer text-m p-4 bg-white hidden">
                                <?php echo wp_kses_post($faq_answer); ?>
                            </div>
                        <?php endif; ?>
                    </div>
                <?php endwhile; ?>
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
                if (currentlyOpen && currentlyOpen !== answer) {
                    currentlyOpen.classList.add('hidden');
                    currentlyOpen.previousElementSibling.classList.remove('bg-gray-200');
                    
                }
                answer.classList.toggle('hidden');
                question.classList.toggle('bg-gray-200');
            });
        });
    });
</script>

<style>

    body
        {
            background-color: white;
          
        }

    .faq-answer.hidden {
        display: none;
    }

    .faq-answer {
        display: block;
        max-height: 0;
        overflow: hidden;
        transition: max-height 0.3s ease;
    }

    .faq-answer:not(.hidden) {
        max-height: 1000px; /* large value for demonstration */
    }

    .faq-question:hover {
        background-color: white;
    }

    .faq-question.bg-gray-200 {
        background-color: white;
    }
</style>
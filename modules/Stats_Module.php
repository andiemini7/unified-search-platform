<?php if( have_rows('stats_module') ): 
    $stats = [];
    while( have_rows('stats_module') ): the_row(); 
        $stats[] = [
            'value' => get_sub_field('statistic_value'),
            'text' => get_sub_field('statistic_text')
        ];
    endwhile;

    // Find the maximum value from the statistics
    $max_value = max(array_column($stats, 'value'));
?>
    <div class="stats-module">
        <div class="stats-card">
            <div class="stat-section">
                <div class="stats-title">OUR STATS</div>
                <?php foreach($stats as $stat): 
                    $bar_width = ($stat['value'] / $max_value) * 100; // Calculate bar width as a percentage
                ?>
                    <div class="stat-content">
                        <div class="stat-label-value">
                            <div class="stat-label"><?php echo $stat['text']; ?></div>
                            <div class="stat-value"><?php echo number_format($stat['value'], 3, '.', ','); ?></div>
                        </div>
                        <div class="stat-bar">
                            <div class="stat-bar-fill" style="width: <?php echo $bar_width; ?>%;"></div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
<?php endif; ?>

<style>
    .stats-module {
    display: flex;
    justify-content: center;
    margin-bottom: 40px;
}

.stats-card {
    position: relative;
    background: #ffffff;
    box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.1);
    border-radius: 20px;
    overflow: hidden;
    width: 80%;
    max-width: 800px;
    padding: 20px;
    transition: all 0.3s ease;
}

.stats-card:hover {
    box-shadow: 0px 8px 24px rgba(0, 0, 0, 0.2);
}

.stat-section {
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    position: relative;
    z-index: 1;
    width: 100%;
}

.stat-content {
    width: 100%;
    margin: 20px 0;
}

.stat-label-value {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 5px;
}

.stat-label {
    font-size: 1.3rem;
    color: #333;
    font-weight: bold;
}

.stat-value {
    font-size: 1.2rem;
    font-weight: bold;
    color: #333;
    text-align: right;
}

.stat-bar {
    position: relative;
    height: 10px;
    border-radius: 5px;
    background: #e0e0e0;
    width: 100%;
    overflow: hidden; 
}

.stat-bar-fill {
    height: 100%;
    border-radius: 5px;
    background: #333;
}

@media (max-width: 768px) {
    .stats-card {
        width: 90%;
    }

    .stat-label-value {
        flex-direction: column;
        align-items: flex-start;
     
    }

    .stat-label, .stat-value {
        width: 100%;
        text-align: left;
    }
}

.stats-title {
    font-size: 1.5rem;
    font-weight: bold;
    margin-bottom: 20px;
}
</style>
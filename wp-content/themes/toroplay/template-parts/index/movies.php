<?php
/*
Template Name: Movie Loader
*/

get_header(); ?>

<section>
    <div class="Top">
        Clip mới
    </div>
    <ul id="movies-container" class="MovieList NoLmtxt Rows AX A06 B04 C03">
        <?php
        global $wpdb;

        // Xác định offset từ URL, mặc định là 12 nếu không có offset
        $offset = isset($_GET['offset']) ? intval($_GET['offset']) : 0;
        $limit = 12;  // Số lượng phim mỗi lần tải thêm

        // Truy vấn các bộ phim theo offset
        $movies = $wpdb->get_results(
            $wpdb->prepare("SELECT * FROM movies ORDER BY id DESC LIMIT %d, %d", $offset, $limit)
        );

        // Hiển thị danh sách phim
        foreach ($movies as $movie) {
            ?>
            <li class="TPostMv">
                <article id="movie-<?php echo esc_attr($movie->id); ?>" class="TPost C">
                    <a href="movies/<?php echo ($movie->id); ?>">
                        <div class="Image">
                            <figure class="Objf TpMvPlay AAIco-play_arrow">
                                <img class="lazy" 
                                     src="<?php echo esc_url($movie->path_img); ?>"  
                                     data-src="<?php echo esc_url($movie->path_img); ?>" 
                                     alt="<?php echo esc_attr($movie->title); ?>">
                            </figure>
                        </div>
                        <h3><?php echo esc_html($movie->title); ?></h3>
                    </a>
                </article>
            </li>
            <?php
        }
        ?>
    </ul>
</section>

<script type="text/javascript">
jQuery(document).ready(function($) {
    var offset = <?php echo $offset; ?>;  // Sử dụng offset từ PHP
    var limit = 12;
    var loading = false;

    // Hàm tải thêm phim
    function loadMoreMovies() {
        if (loading) return;  // Nếu đang tải thì không thực hiện thêm yêu cầu
        loading = true;

        $.get(window.location.href.split('?')[0] + '?offset=' + (offset + limit), function(response) {
            var newMovies = $(response).find('#movies-container').html();
            $('#movies-container').append(newMovies);  // Thêm phim mới vào danh sách

            // Cập nhật lại hình ảnh lazy load
            // updateLazyImages();  // Gọi hàm cập nhật src cho tất cả ảnh lazy

            offset += limit;  // Cập nhật offset
            loading = false;  // Đánh dấu kết thúc việc tải phim
        });
    }

    // Hàm sử dụng Intersection Observer để thay đổi src khi ảnh gần vào viewport
    function updateLazyImages() {
        // Lấy tất cả các hình ảnh lazy
        var lazyImages = document.querySelectorAll('img.lazy');

        // Dùng Intersection Observer để theo dõi hình ảnh và thay đổi src khi ảnh vào viewport
        const loadImages = (image) => {
            const dataSrc = image.getAttribute('data-src');
            if (dataSrc) {
                image.src = dataSrc;
                image.classList.remove('lazy');
            }
        };

        const observer = new IntersectionObserver((entries, observer) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    loadImages(entry.target);
                    observer.unobserve(entry.target);
                }
            });
        });

        lazyImages.forEach(image => {
            observer.observe(image);
        });
    }

    // Kiểm tra cuộn trang và tải thêm phim khi gần hết trang
    $(window).scroll(function() {
        if ($(window).scrollTop() + $(window).height() >= $(document).height() - 100) {
            loadMoreMovies();  // Tải thêm phim khi cuộn xuống gần cuối trang
        }
    });

    // Gọi hàm cập nhật lại ảnh lazy load khi trang được tải lần đầu
    // updateLazyImages();
});
</script>

<?php get_footer(); ?>

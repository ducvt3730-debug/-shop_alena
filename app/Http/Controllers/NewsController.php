<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function index()
    {
        $news = [
            [
                'id' => 1,
                'title' => 'Cách phối đồ hè nam',
                'slug' => 'cach-phoi-do-he-nam',
                'excerpt' => '1. Sơ mi hoa tiết + quần denim + giày sneaker. Hãy tranh thủ những ngày hè để diện ngay chiếc áo sơ mi hoa tiết cá tính kết hợp cùng quần jeans và giày sneaker năng động...',
                'content' => 'Nội dung chi tiết về cách phối đồ hè nam...',
                'author' => 'Cafein Team',
                'date' => '2022-05-27',
                'image' => 'news-1.jpg'
            ],
            [
                'id' => 2,
                'title' => 'Cách phối đồ với quần thể thao nam',
                'slug' => 'cach-phoi-do-voi-quan-the-thao-nam',
                'excerpt' => '1. Quần jogger thể thao phối với áo khoác da. Nếu bạn nghĩ rằng áo khoác da chỉ có thể kết hợp với quần jeans thì bạn đã nhầm. Sự kết hợp giữa áo khoác da và quần jogger...',
                'content' => 'Nội dung chi tiết về cách phối đồ với quần thể thao nam...',
                'author' => 'Cafein Team',
                'date' => '2022-05-27',
                'image' => 'news-2.jpg'
            ],
            [
                'id' => 3,
                'title' => 'Cách phối đồ sơ mi nam',
                'slug' => 'cach-phoi-do-so-mi-nam',
                'excerpt' => '1. Quần jean ống đứng. Cách phối đồ với áo sơ mi nam đầu tiên mà chúng tôi gợi ý cho các bạn là mix áo sơ mi với quần jean ống đứng - item kinh điển không bao giờ lỗi mốt...',
                'content' => 'Nội dung chi tiết về cách phối đồ sơ mi nam...',
                'author' => 'Cafein Team',
                'date' => '2022-05-27',
                'image' => 'news-3.jpg'
            ],
            [
                'id' => 4,
                'title' => 'Xu hướng thời trang nữ 2024',
                'slug' => 'xu-huong-thoi-trang-nu-2024',
                'excerpt' => 'Khám phá những xu hướng thời trang nữ hot nhất năm 2024 với những gam màu, chất liệu và kiểu dáng được yêu thích...',
                'content' => 'Nội dung chi tiết về xu hướng thời trang nữ 2024...',
                'author' => 'Fashion Team',
                'date' => '2024-01-15',
                'image' => 'news-4.jpg'
            ],
            [
                'id' => 5,
                'title' => 'Bí quyết chọn giày phù hợp với từng dáng người',
                'slug' => 'bi-quyet-chon-giay-phu-hop-voi-tung-dang-nguoi',
                'excerpt' => 'Việc chọn giày phù hợp không chỉ giúp bạn thoải mái mà còn tôn lên vẻ đẹp tự nhiên của đôi chân...',
                'content' => 'Nội dung chi tiết về cách chọn giày phù hợp...',
                'author' => 'Style Expert',
                'date' => '2024-01-10',
                'image' => 'news-5.jpg'
            ]
        ];
        
        return view('news.index', compact('news'));
    }

    public function show($slug)
    {
        $news = [
            'cach-phoi-do-he-nam' => [
                'title' => 'Cách phối đồ hè nam',
                'content' => '
                    <h2>1. Sơ mi hoa tiết + quần denim + giày sneaker</h2>
                    <p>Hãy tranh thủ những ngày hè để diện ngay chiếc áo sơ mi hoa tiết cá tính kết hợp cùng quần jeans và giày sneaker năng động. Combo này vừa thoải mái, vừa thời trang và phù hợp cho nhiều hoàn cảnh khác nhau.</p>
                    
                    <h2>2. Áo thun + quần short + dép sandal</h2>
                    <p>Đây là set đồ kinh điển cho những ngày hè nóng bức. Chọn áo thun cotton thoáng mát, quần short vừa vặn và đôi dép sandal chất lượng để có được vẻ ngoài thoải mái nhất.</p>
                    
                    <h2>3. Áo polo + quần kaki + giày loafer</h2>
                    <p>Nếu bạn muốn có vẻ ngoài lịch sự hơn một chút, hãy thử combo áo polo kết hợp với quần kaki và giày loafer. Đây là lựa chọn hoàn hảo cho những buổi hẹn hò hoặc đi làm trong mùa hè.</p>
                ',
                'author' => 'Cafein Team',
                'date' => '2022-05-27',
                'image' => 'news-1.jpg'
            ],
            'cach-phoi-do-voi-quan-the-thao-nam' => [
                'title' => 'Cách phối đồ với quần thể thao nam',
                'content' => '
                    <h2>1. Quần jogger thể thao phối với áo khoác da</h2>
                    <p>Nếu bạn nghĩ rằng áo khoác da chỉ có thể kết hợp với quần jeans thì bạn đã nhầm. Sự kết hợp giữa áo khoác da và quần jogger tạo nên phong cách street style cực kỳ ấn tượng.</p>
                    
                    <h2>2. Quần thể thao + áo hoodie + giày sneaker</h2>
                    <p>Đây là combo kinh điển cho phong cách sporty. Chọn những màu sắc hài hòa và thương hiệu uy tín để có được set đồ hoàn hảo.</p>
                    
                    <h2>3. Quần track pants + áo thun oversized</h2>
                    <p>Phong cách thoải mái và trendy, phù hợp cho những ngày cuối tuần hoặc khi đi chơi với bạn bè.</p>
                ',
                'author' => 'Cafein Team',
                'date' => '2022-05-27',
                'image' => 'news-2.jpg'
            ]
        ];
        
        $article = $news[$slug] ?? null;
        
        if (!$article) {
            abort(404);
        }
        
        return view('news.show', compact('article'));
    }
}
@extends('layouts.app')

@section('title', 'Hướng dẫn chọn size - Alena')

@section('content')
<style>
    .size-guide-container {
        margin: 50px 0;
        max-width: 800px;
        margin-left: auto;
        margin-right: auto;
    }
    
    .page-title {
        font-size: 28px;
        font-weight: bold;
        text-align: center;
        margin-bottom: 40px;
        color: #333;
    }
    
    .guide-content {
        background: white;
        padding: 40px;
        border-radius: 8px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }
    
    .size-table {
        width: 100%;
        border-collapse: collapse;
        margin: 20px 0;
        background: white;
    }
    
    .size-table th,
    .size-table td {
        padding: 12px;
        text-align: center;
        border: 1px solid #ddd;
    }
    
    .size-table th {
        background-color: #d32f2f;
        color: white;
        font-weight: 600;
    }
    
    .size-table tr:nth-child(even) {
        background-color: #f9f9f9;
    }
    
    .guide-section {
        margin-bottom: 30px;
    }
    
    .guide-section h3 {
        font-size: 20px;
        font-weight: bold;
        margin-bottom: 15px;
        color: #d32f2f;
    }
    
    .guide-section p {
        line-height: 1.6;
        margin-bottom: 15px;
        color: #333;
    }
</style>

<div class="container">
    <div class="size-guide-container">
        <h1 class="page-title">Hướng dẫn chọn size</h1>
        
        <div class="guide-content">
            <div class="guide-section">
                <h3>Bảng size áo nam</h3>
                <table class="size-table">
                    <thead>
                        <tr>
                            <th>Size</th>
                            <th>Chiều cao (cm)</th>
                            <th>Cân nặng (kg)</th>
                            <th>Ngực (cm)</th>
                            <th>Eo (cm)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>S</td>
                            <td>160-165</td>
                            <td>50-60</td>
                            <td>88-92</td>
                            <td>76-80</td>
                        </tr>
                        <tr>
                            <td>M</td>
                            <td>165-170</td>
                            <td>60-70</td>
                            <td>92-96</td>
                            <td>80-84</td>
                        </tr>
                        <tr>
                            <td>L</td>
                            <td>170-175</td>
                            <td>70-80</td>
                            <td>96-100</td>
                            <td>84-88</td>
                        </tr>
                        <tr>
                            <td>XL</td>
                            <td>175-180</td>
                            <td>80-90</td>
                            <td>100-104</td>
                            <td>88-92</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            
            <div class="guide-section">
                <h3>Bảng size áo nữ</h3>
                <table class="size-table">
                    <thead>
                        <tr>
                            <th>Size</th>
                            <th>Chiều cao (cm)</th>
                            <th>Cân nặng (kg)</th>
                            <th>Ngực (cm)</th>
                            <th>Eo (cm)</th>
                            <th>Hông (cm)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>S</td>
                            <td>150-160</td>
                            <td>40-50</td>
                            <td>80-84</td>
                            <td>64-68</td>
                            <td>88-92</td>
                        </tr>
                        <tr>
                            <td>M</td>
                            <td>160-165</td>
                            <td>50-60</td>
                            <td>84-88</td>
                            <td>68-72</td>
                            <td>92-96</td>
                        </tr>
                        <tr>
                            <td>L</td>
                            <td>165-170</td>
                            <td>60-70</td>
                            <td>88-92</td>
                            <td>72-76</td>
                            <td>96-100</td>
                        </tr>
                        <tr>
                            <td>XL</td>
                            <td>170-175</td>
                            <td>70-80</td>
                            <td>92-96</td>
                            <td>76-80</td>
                            <td>100-104</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            
            <div class="guide-section">
                <h3>Cách đo size chính xác</h3>
                <p><strong>Đo vòng ngực:</strong> Đặt thước dây quanh phần rộng nhất của ngực, giữ thước song song với mặt đất.</p>
                <p><strong>Đo vòng eo:</strong> Đặt thước dây quanh phần nhỏ nhất của eo, thường là trên rốn khoảng 2-3cm.</p>
                <p><strong>Đo vòng hông:</strong> Đặt thước dây quanh phần rộng nhất của hông.</p>
            </div>
            
            <div class="guide-section">
                <h3>Lưu ý khi chọn size</h3>
                <p>• Nếu số đo của bạn nằm giữa 2 size, hãy chọn size lớn hơn để thoải mái hơn.</p>
                <p>• Với áo len hoặc áo khoác, nên chọn size lớn hơn 1 size so với áo thun.</p>
                <p>• Nếu bạn thích mặc rộng, hãy chọn size lớn hơn 1-2 size.</p>
                <p>• Liên hệ với chúng tôi nếu bạn cần tư vấn thêm về size.</p>
            </div>
        </div>
    </div>
</div>
@endsection


<?php
declare(strict_types=1);

use App\Library\ChronosLibrary;
use Cake\ORM\TableRegistry;
use Migrations\AbstractSeed;

/**
 * Prefectures seed.
 */
class PrefecturesSeed extends AbstractSeed
{
    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeds is available here:
     * https://book.cakephp.org/phinx/0/en/seeding.html
     *
     * @return void
     */
    public function run()
    {
        $data = [];
        $executeTime = ChronosLibrary::getSystemDateTime();
        $prefectureList = [
            "北海道",
            "青森県",
            "岩手県",
            "宮城県",
            "秋田県",
            "山形県",
            "福島県",
            "茨城県",
            "栃木県",
            "群馬県",
            "埼玉県",
            "千葉県",
            "東京都",
            "神奈川県",
            "新潟県",
            "富山県",
            "石川県",
            "福井県",
            "山梨県",
            "長野県",
            "岐阜県",
            "静岡県",
            "愛知県",
            "三重県",
            "滋賀県",
            "京都府",
            "大阪府",
            "兵庫県",
            "奈良県",
            "和歌山県",
            "鳥取県",
            "岡山県",
            "広島県",
            "島根県",
            "山口県",
            "徳島県",
            "香川県",
            "高知県",
            "愛媛県",
            "福岡県",
            "佐賀県",
            "長崎県",
            "大分県",
            "熊本県",
            "宮崎県",
            "鹿児島県",
            "沖縄県",
        ];

        // 既にデータが入っている場合は実行しない
        $prefectures = TableRegistry::getTableLocator()->get('prefectures');
        if ($prefectures->find()->count() == 0) {
            foreach ($prefectureList as $key => $prefectureName) {
                $data[] = [
                    'prefecture_name' => $prefectureName,
                    'created' => $executeTime,
                ];
            }

            $table = $this->table('prefectures');
            $table->insert($data)->save();
        }
    }
}

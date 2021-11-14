<?php

use yii\db\Migration;

/**
 * Class m210221_123748_insert_data_into_text_block
 */
class m210221_123748_insert_data_into_text_block extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->batchInsert('text_block', ['shortcut', 'text'], [
            [
                'about1',
                'Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut lao dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper lobortis
                nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hend rerit in vulputate esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odioqui blandit
                praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi.Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dol ore eu feugiat nulla facilisis at vero
                eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi. Nam liber tempor cum soluta nobis eleifend option congue nihil imperdiet doming id quod
                mazim placerat facer possim assum.'
            ],
            [
                'about2',
                'Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut lao dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper lobortis
                nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hend rerit in vulputate esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odioqui blandit
                praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi.Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse.'
            ],
            [
                'about3',
                'Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laodolore magna aliquam erat volutpat. Ut wisi minim veniam, quis nostrud exerci tation ullamcorper lobortis nisl ut
                aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in v esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio diqui blandit praesent
                luptatum zzril delenit aug s dolore te feugait nulla facilisi.Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laodolore magna m erat volutpat. Ut wisi enim ad minim
                veniam, quis nostrud exerci tation ullamcorper lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel riure dolor in hendrerit in vulputateesse molestie consequat, vel illum dolore eu feugiat nulla facilisis
                at vero eros et accumsan et iusto odio diqui blandit nt luptatum zzril delenit augue duis dolore te feugait nulla facilisi.'
            ]
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->delete('text_block', [
            'shortcut' => 'about1'
        ]);
        $this->delete('text_block', [
            'shortcut' => 'about2'
        ]);
        $this->delete('text_block', [
            'shortcut' => 'about3'
        ]);
        return true;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210221_123748_insert_data_into_text_block cannot be reverted.\n";

        return false;
    }
    */
}

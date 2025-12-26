<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
  /**
   * 1. マスアサインメント設定(store/updateで一括代入を許可するカラム)
   */
  protected $fillable = [
    'title',
    'status',
  ];

  /**
   * 2. ステータスの定数定義(DBに保存する文字列)
   */
  public const STATUS_PENDING     = 'pending';     // 未着手
  public const STATUS_IN_PROGRESS = 'in_progress'; // 着手
  public const STATUS_COMPLETED   = 'completed';   // 完了

  /**
   * 3. 静的メソッド: 全てのステータスと表示名を取得
   * @return array<string, string>
   */
  public static function getStatusOptions(): array
  {
    return [
      self::STATUS_PENDING     => '未着手',
      self::STATUS_IN_PROGRESS => '着手',
      self::STATUS_COMPLETED   => '完了',
    ];
  }
}

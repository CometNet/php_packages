<?php


namespace Huixing\UCenter\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Facades\Storage;

class User extends Model implements AuthenticatableContract
{
    use Authenticatable;

    protected $fillable = ['username', 'password', 'name', 'avatar'];

    /**
     * Create a new Eloquent model instance.
     *
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        $connection = config('ucenter.database.connection') ?: config('database.default');

        $this->setConnection($connection);

        $this->setTable(config('ucenter.database.users_table'));

        parent::__construct($attributes);
    }

    /**
     * Get avatar attribute.
     *
     * @param string $avatar
     *
     * @return string
     */
    public function getAvatarAttribute($avatar)
    {
        if (url()->isValidUrl($avatar)) {
            return $avatar;
        }

        $disk = config('ucenter.upload.disk');

        if ($avatar && array_key_exists($disk, config('filesystems.disks'))) {
            return Storage::disk(config('ucenter.upload.disk'))->url($avatar);
        }

        $default = config('ucenter.default_avatar') ?: '/vendor/ucenter/AdminLTE/dist/img/user2-160x160.jpg';

        return ucenter_asset($default);
    }

}
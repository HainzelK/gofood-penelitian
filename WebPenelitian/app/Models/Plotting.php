// app/Models/Plotting.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Plotting extends Model
{
    protected $fillable = ['name', 'location', 'max_capacity'];
    
    public function users()
    {
        return $this->hasMany(User::class, 'plotting', 'name');
    }
    
    public function getCurrentCountAttribute()
    {
        return User::where('plotting', $this->name)
                   ->where('domisili', $this->location)
                   ->count();
    }
    
    public function isFull()
    {
        return $this->current_count >= $this->max_capacity;
    }
    
    public function getAvailableSlotsAttribute()
    {
        return $this->max_capacity - $this->current_count;
    }
}
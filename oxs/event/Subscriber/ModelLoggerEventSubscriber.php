<?php declare(strict_types=1);

namespace OxidSupport\Event\Subscriber;

use OxidEsales\EshopCommunity\Internal\Framework\Event\AbstractShopAwareEventSubscriber;
use OxidEsales\EshopCommunity\Internal\Transition\ShopEvents\AfterModelInsertEvent;
use OxidEsales\EshopCommunity\Internal\Transition\ShopEvents\AfterModelUpdateEvent;
use Psr\Log\LoggerInterface;
use Symfony\Component\EventDispatcher\Event;

class ModelLoggerEventSubscriber extends AbstractShopAwareEventSubscriber
{

  /** @var LoggerInterface */
  private $logger;

  public function __construct(LoggerInterface $logger)
  {
      $this->logger = $logger;
  }

  public function logDatabaseActivity(Event $event)
  {
      $model = $event->getModel();
      $id = "unknown";
      try {
          $id = $model->getId();
      } catch (\Exception $e) {
          // pass
      }

      $this->logger->info("Saved object of type " . get_class($model) . " with id " . $id);

  }

    public static function getSubscribedEvents()
    {
        return [
            AfterModelUpdateEvent::NAME => 'logDatabaseActivity',
            AfterModelInsertEvent::NAME => 'logDatabaseActivity',
        ];
    }
}